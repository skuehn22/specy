<?php
namespace App\Classes;

use App, Auth, DB, Hash;
use MangoPay, Redirect, Request;
use App\Http\Controllers\Controller;
use App\DatabaseModels\CompaniesMangowallets;
use App\DatabaseModels\Companies;
use App\DatabaseModels\ClientsMangowallets;
use App\DatabaseModels\Clients;
use App\DatabaseModels\MangoKyc;

class MangoClass extends Controller
{

    /**
     * @var \MangoPay\MangoPayApi
     */

    private $mangopay;

    public function __construct(\MangoPay\MangoPayApi $mangopay) {

        $this->mangopay = $mangopay;

    }

    public function index() {

        if(isset($_GET['transactionId'])){
            return Redirect::to("/mangopay/sandbox")->withInput()->with('success', 'PayIn ('.$_GET['transactionId'].') erfolgreich durchgeführt');
        }else{
            $users = $this->getAllUser();
            $wallets = $this->getWalletInfo();

            return view('backend.mangopay.sandbox_index', compact('blade', 'users', 'wallets'));
        }

    }

    public function createTransaction($company, $client, $milestone, $planHash)
    {

        $input = Request::all();

        $blade["locale"] = App::getLocale();
        
        $user = App\DatabaseModels\Users::where("id", "=", $company->users_fk)
            ->first();

        //check if already an performer with this email exists


        //if ($company->mango_id != 0) {
        //    $mango_freelancer = $this->getUser($company);
        //} else {
        //    $mango_freelancer = $this->createLegalUser($company, $user);

        //    $company = Companies::where("users_fk", "=", $user->id)
        //       ->first();

        //   $company->mango_id = $mango_freelancer->Id;
        //   $company->save();

        //}


        //check if already an client with this email exists
        if ($client->mango_id != 0) {
            $mango_client = $this->getUser($client->mango_id);
        } else {
            $mango_client = $this->createNaturalUser($client, $client);

            $client = Clients::where("id", "=", $client->id)
                ->first();

            $client->mango_id = $mango_client->Id;
            $client->save();

        }

        //get wallet for performer and client


        //$freelancer_wallet_id = $this->getMangoWallets($mango_freelancer->Id);

        $client_wallets = $this->getMangoWallets($mango_client->Id);

        foreach ($client_wallets as $client_wallet){

            if($client_wallet->Currency ==  $milestone->currency){
                $client_wallet_id = $client_wallet->Id;
            }
        }


        //if there is no wallet create one

        /*
        if (!$freelancer_wallet_id) {
            $freelancer_wallet = $this->createWallet($mango_freelancer->Id);
            $freelancer_wallet_id = $freelancer_wallet->Id;
            $wallet = new CompaniesMangowallets();
            $wallet->id = $freelancer_wallet_id;
            $wallet->performer_id_fk = $company->id;
            $wallet->save();
        }
        */

        //if there is no wallet create one
        if (!isset($client_wallet_id)) {
            $client_wallet = $this->createWallet($mango_client->Id, $milestone->currency);
            $client_wallet_id = $client_wallet->Id;
            $wallet = new ClientsMangowallets();
            $wallet->id = $client_wallet->Id;
            $wallet->client_id_fk = $client->id;
            $wallet->currency = $milestone->currency;
            $wallet->save();
        }

        //$freelancer_wallet_id = credited_wallet
        $hash = $this->prepPayInCardWeb($mango_client->Id, $client_wallet_id, $milestone);
        $url = $this->openTransaction($hash, $planHash);
        return $url;

    }

    public function createUser($company, $user) {
        try {

            // create user for payment
            $mangouser = new MangoPay\UserNatural();
            $mangouser->FirstName = $company->firstname;
            $mangouser->LastName = $company->lastname;
            $mangouser->Email = $user->email;
            $mangouser->Birthday = time();
            $mangouser->Nationality = 'IRL';
            $mangouser->CountryOfResidence = 'IRL';
            $mangouser->Occupation = "Freelancer";
            $mangouser->IncomeRange = 3;
            $createdUser = $this->mangopay->Users->Create($user);

                return $createdUser;



        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }



    }

    public function createLegalUser($company, $user) {
        try {

            // create user for payment
            $mangouser = new MangoPay\UserLegal();

            if($company->type == 1){
                $mangouser->LegalPersonType = \MangoPay\LegalPersonType::Soletrader;
            }elseif($company->type == 2){
                $mangouser->LegalPersonType = \MangoPay\LegalPersonType::Business;
            }else{
                $mangouser->LegalPersonType = \MangoPay\LegalPersonType::Organization;
            }

            $mangouser->Name = $company->name;
            $mangouser->Email = $user->email;
            $mangouser->LegalRepresentativeFirstName =  $company->firstname;
            $mangouser->LegalRepresentativeLastName =  $company->lastname;

            if(isset($company->birthday)){
                $mangouser->LegalRepresentativeBirthday = strtotime($company->birthday);;
            }else{
                $mangouser->LegalRepresentativeBirthday = time();
            }

            if(isset($company->country_nationality)){
                $mangouser->LegalRepresentativeNationality = $company->country_nationality;
            }else{
                $mangouser->LegalRepresentativeNationality = "IE";
            }

            if(isset($company->country_residence)){
                $mangouser->LegalRepresentativeCountryOfResidence = $company->country_residence;
            }else{
                $mangouser->LegalRepresentativeCountryOfResidence = "IE";
            }

            $createdUser = $this->mangopay->Users->Create($mangouser);

            return $createdUser;


        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function getAllUser() {
        try {

            //$pagination = new MangoPay\Pagination(1, 8);
            $users =$this->mangopay->Users->GetAll();

            return $users;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function getWalletsIn() {
        try {

            $wallets =$this->mangopay->Users->GetWallets($_GET['id']);
            return view('backend.mangopay.sandbox_get_wallets', compact('wallets'));


        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function getWalletsOut() {
        try {

            $wallets =$this->mangopay->Users->GetWallets($_GET['id']);
            return view('backend.mangopay.sandbox_set_payout', compact('wallets'));


        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function createCard($createdUser){

        // register card
        $cardRegister = new \MangoPay\CardRegistration();
        $cardRegister->UserId = $createdUser->Id;
        $cardRegister->Currency = $_SESSION['currency'];
        $cardRegister->CardType = $_SESSION['cardType'];
        $createdCardRegister = $this->mangopay->CardRegistrations->Create($cardRegister);
        $_SESSION['cardRegisterId'] = $createdCardRegister->Id;


        //$cardRegister = $this->mangopay->CardRegistrations->Get($_SESSION['cardRegisterId']);
        //$cardRegister->RegistrationData = isset($_GET['data']) ? 'data=' . $_GET['data'] : 'errorCode=' . $_GET['errorCode'];
        //$updatedCardRegister = $this->mangopay->CardRegistrations->Update($cardRegister);
        //if ($updatedCardRegister->Status != \MangoPay\CardRegistrationStatus::Validated || !isset($updatedCardRegister->CardId))
        //    die('<div style="color:red;">Cannot create card. Payment has not been created.<div>');

        // get created virtual card object
        $card = $_SESSION['cardRegisterId'];

        return $card;
    }

    public function getWalletInfo(){

        $WalletId = 55576741;
        $Wallet = $this->mangopay->Wallets->Get($WalletId);

        return $Wallet;

    }

    public function getUser($id) {
        try {

            $mangoPerformer = $this->mangopay->Users->Get($id);
            return $mangoPerformer;


        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }
    }

    public function createNaturalUser($person, $account) {
        try {

            // create user for payment

            $user = new MangoPay\UserNatural();
            $user->Email = $account->email;

            if(isset($person->firstname)){
                $user->FirstName = $person->firstname;
                $user->LastName = $person->lastname;
            }else{
                if($account->firstname){
                    $user->FirstName = $account->firstname;
                    $user->LastName = $account->lastname;
                }else{
                    $user->FirstName = "John";
                    $user->LastName = "Doe";
                }
            }


            if(isset($person->birthday)){
                $user->Birthday = strtotime($person->birthday);
            }else{
                $user->Birthday = time();
            }

            if(isset($person->country_nationality)){
                $user->Nationality = $person->country_nationality;
            }else{
                $user->Nationality = "IE";
            }

            if(isset($person->country_residence)){
                $user->CountryOfResidence = $person->country_residence;
            }else{
                $user->CountryOfResidence = "IE";
            }

            $result =  $this->mangopay->Users->Create($user);

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

        return $result;
    }

    public function getMangoWallets($id) {
        try {

            $wallets =$this->mangopay->Users->GetWallets($id);

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }


        return $wallets;

    }

    public function createWallet($user, $currency) {
        try {

            // create temporary wallet for user
            $wallet = new \MangoPay\Wallet();
            $wallet->Owners = array( $user );
            $wallet->Currency = $currency;
            $wallet->Description = "default";
            $createdWallet = $this->mangopay->Wallets->Create($wallet);

            return $createdWallet;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }
    }

    public function prepPayInCardWeb($author, $credited_wallet, $milestone) {

        try {

            $hash =  base64_encode(Hash::make(time()));

            $payin = new App\DatabaseModels\MangoPayin();
            $payin->hash = $hash;
            $payin->milestone_id_fk = $milestone->id;

            // client mango id (DB table clients)
            $payin->author_id = $author;

            // this is the freelancer wallet
            $payin->credited_wallet = $credited_wallet;

            $payin->amount = $milestone->amount;
            $payin->currency = $milestone->currency;
            $payin->payment_type = "CARD";
            $payin->execution_type = "WEB";
            $payin->state = "PREP";
            $payin->save();

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

        return $hash;

    }


    public function openTransaction($hash, $planHash){

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        $payIn = $this->createPayInCardWeb($hash, $planHash);

        return $payIn;

    }

    public function createPayInCardWeb($hash, $planHash) {

        try {

            $prepedPayIn = App\DatabaseModels\MangoPayin::where("hash", "=", $hash)
                ->first();

            // create pay-in CARD DIRECT
            $payIn = new \MangoPay\PayIn();
            $payIn->CreditedWalletId = $prepedPayIn->credited_wallet;
            $payIn->AuthorId = $prepedPayIn->author_id;
            $payIn->PaymentType = "CARD";
            $payIn->PaymentDetails = new \MangoPay\PayInPaymentDetailsCard();
            $payIn->PaymentDetails->CardType = "CB_VISA_MASTERCARD";
            $payIn->DebitedFunds = new \MangoPay\Money();
            $payIn->DebitedFunds->Amount = $prepedPayIn->amount*100;
            $payIn->DebitedFunds->Currency = $prepedPayIn->currency;
            $payIn->Fees = new \MangoPay\Money();
            $payIn->Fees->Amount = 0;
            $payIn->Fees->Currency = $prepedPayIn->currency;
            $payIn->ExecutionType = "WEB";
            $payIn->ExecutionDetails = new \MangoPay\PayInExecutionDetailsWeb();
            $payIn->ExecutionDetails->ReturnURL = env("APP_URL") . "/" . App::getLocale() . "/payment-plan/".$planHash;
            $payIn->ExecutionDetails->Culture = "EN";
            //$payIn->ExecutionDetails->TemplateURLOptions = new \MangoPay\PayInTemplateURLOptions();
            //$payIn->ExecutionDetails->TemplateURLOptions->PAYLINE = "https://www.trustfy.io/mangopay/payline-template";


            $result = $this->mangopay->PayIns->Create($payIn);

            $prepRedirect = $result->ExecutionDetails;

            $prepedPayIn->mango_id = $result->Id;
            $prepedPayIn->state = $result->Status;
            $prepedPayIn->result_code = $result->ResultCode;
            $prepedPayIn->result_message = $result->ResultMessage;
            $prepedPayIn->save();


            return $prepRedirect;



        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }
    }


    public function getPayInCardWeb($payInId) {

        try {

            $result = $this->mangopay->PayIns->Get($payInId);
            return $result;


        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }
    }

    public function createBankAccount($bank, $company){

        try {

        $UserId = $company->mango_id;
        $BankAccount = new \MangoPay\BankAccount();
        $BankAccount->Details = new MangoPay\BankAccountDetailsIBAN();
        $BankAccount->OwnerAddress = new \MangoPay\Address();
        $BankAccount->OwnerAddress->AddressLine1 = $bank->address1;
        $BankAccount->OwnerAddress->AddressLine2 = $bank->address2;
        $BankAccount->OwnerAddress->City = $bank->city;
        $BankAccount->OwnerAddress->PostalCode = $bank->zip;
        $BankAccount->OwnerAddress->Country = $bank->country_iso;
        $BankAccount->OwnerName = $bank->name;
        $BankAccount->IBAN = $bank->iban;
        $BankAccount->BIC = $bank->bic;

        $result = $this->mangopay->Users->CreateBankAccount($UserId, $BankAccount);

        return $result;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function getBankAccount($user, $bankId){

        try {

            $UserId = $user;
            $result = $this->mangopay->Users->GetBankAccount($UserId, $bankId);
            return $result;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function deactivateBankAccount($user, $account){

        try {

            $account->Active = false;
            $accountResult = $this->mangopay->Users->UpdateBankAccount($user, $account);
            return $accountResult;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }


    public function createKycDocument($company, $doctype){

        try {

            $UserId = $company->mango_id;

            $KycDocument = new \MangoPay\KycDocument();
            $KycDocument->Tag = "";
            $KycDocument->Type = $doctype;

            $result = $this->mangopay->Users->CreateKycDocument($UserId, $KycDocument);

            return $result;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function createKycPage($company, $kycdoc, $file){

        try {

            $UserId = $company->mango_id;
            $KYCDocumentId  = $kycdoc;

            $KycPage = new \MangoPay\KycPage();
            $KycPage->File = $file;

            $result = $this->mangopay->Users->CreateKycPage($UserId, $KYCDocumentId, $KycPage);

            return $result;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }


    public function submitKycDocument($company, $docId){

        try {

            $UserId = $company->mango_id;

            $KycDocument = new \MangoPay\KycDocument();
            $KycDocument->Tag = "";
            $KycDocument->Status = "VALIDATION_ASKED";
            $KycDocument->Id = $docId;


            $result = $this->mangopay->Users->UpdateKycDocument($UserId, $KycDocument);

            return $result;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }


    public function checkKycDocuments($company, $docs){

        try {

            $UserId = $company->mango_id;

            foreach ($docs as $doc){

                $KYCDocumentId = $doc->created_id;
                $result = $this->mangopay->Users->GetKycDocument($UserId, $KYCDocumentId);

                if($result->Status !=  $doc->status){

                    $kyc_doc_obj = MangoKyc::where("created_id", "=",  $doc->created_id)
                        ->first();

                    $kyc_doc_obj->status = $result->Status;
                    $kyc_doc_obj->refused_reason_msg = $result->RefusedReasonMessage;
                    $kyc_doc_obj->refused_reason_type = $result->RefusedReasonType;
                    $kyc_doc_obj->save();

                }

            }


            return $result;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }


    public function getKycDocuments($KYCDocumentId ){

        try {

            $userId = "";
            $result = $this->mangopay->Users->GetKycDocument($userId, $KYCDocumentId);


            return $result;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }



    public function createPayOut($author, $milestone, $bank, $wallet, $user){
        try {

            //$wallet = "61451381";
            //$user = "61450664";
            //$amount = $milestone->amount;
            //$bank = "62091760";

            $PayOut = new \MangoPay\PayOut();
            $PayOut->AuthorId = $author;
            $PayOut->DebitedWalletID = $wallet->id;
            $PayOut->DebitedFunds = new \MangoPay\Money();
            $PayOut->DebitedFunds->Currency = $milestone->currency;
            $PayOut->DebitedFunds->Amount = $milestone->amount*100;
            $PayOut->Fees = new \MangoPay\Money();
            $PayOut->Fees->Currency = $milestone->currency;

            if($user->free==1){
                $PayOut->Fees->Amount = 0;
            }else{
                $PayOut->Fees->Amount = $milestone->amount*0.03*100;
            }

            $PayOut->PaymentType = "BANK_WIRE";
            $PayOut->MeanOfPaymentDetails = new \MangoPay\PayOutPaymentDetailsBankWire();
            $PayOut->MeanOfPaymentDetails->BankAccountId = $bank->mango_bank_id;
            $result = $this->mangopay->PayOuts->Create($PayOut);

            return $result;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function createTransfer($client_mango_id, $milestone, $client_wallet, $freelancer_wallet){
        try {


            $Transfer = new \MangoPay\Transfer();
            $Transfer->Tag = "custom meta";
            $Transfer->AuthorId = $client_mango_id;
            $Transfer->DebitedFunds = new \MangoPay\Money();
            $Transfer->DebitedFunds->Currency = $milestone->currency;
            $Transfer->DebitedFunds->Amount = $milestone->amount*100;
            $Transfer->Fees = new \MangoPay\Money();
            $Transfer->Fees->Currency = $milestone->currency;
            $Transfer->Fees->Amount = 0;
            $Transfer->DebitedWalletId = $client_wallet->id;
            $Transfer->CreditedWalletId = $freelancer_wallet->id;

            $result = $this->mangopay->Transfers->Create($Transfer);

            return $result;

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }



}
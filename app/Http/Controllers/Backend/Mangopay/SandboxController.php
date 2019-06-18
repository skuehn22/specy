<?php
namespace App\Http\Controllers\Backend\Mangopay;

use MangoPay, Redirect;
use App\Http\Controllers\Controller;

class SandboxController extends Controller
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

    public function allOperations() {

        try {

            // sample data to demo
            $_SESSION['amount'] = 33000;
            $_SESSION['currency'] = 'EUR';
            $_SESSION['cardType'] = 'CB_VISA_MASTERCARD';//or alternatively MAESTRO or DINERS etc

            /** create USer **/
            //$createdUser = $this->createUser();
            $user = '55498120';

            /** add card **/
            //$card = $this->createWallet($createdUser);

            /**  create temporary wallet for user **/
            //$createdWallet = $this->createWallet();
            $wallet =  '55504604';

            /** create a payin */


            $makePayment = $this->createPayIn($wallet, $user);
            $test = $makePayment->ExecutionDetails;
            return Redirect::to( $test->RedirectURL );


            //$result = $this->mangopay->PayIns->Get('55504662');


            /** cretae refund */

            //$this->createRefund();
            //$this->createBankAccount();
            //$this->createPayout();

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }




    public function createBankAccount(){

        $UserId = '55498018';
        $BankAccount = new \MangoPay\BankAccount();
        $BankAccount->Details = new MangoPay\BankAccountDetailsIBAN();
        $BankAccount->Tag = "custom meta";
        $BankAccount->OwnerAddress = new \MangoPay\Address();
        $BankAccount->OwnerAddress->AddressLine1 = "1 Mangopay Street";
        $BankAccount->OwnerAddress->AddressLine2 = "The Loop";
        $BankAccount->OwnerAddress->City = "Paris";
        $BankAccount->OwnerAddress->Region = "Ile de France";
        $BankAccount->OwnerAddress->PostalCode = "75001";
        $BankAccount->OwnerAddress->Country = "FR";
        $BankAccount->OwnerName = "Joe Blogs";
        $BankAccount->IBAN = "FR3020041010124530725S03383";
        $BankAccount->BIC = "CRLYFRPP";

        $result = $this->mangopay->Users->CreateBankAccount($UserId, $BankAccount);

    }


    public function createPayOut(){
        try {

            $wallet = $_POST['users_wallets'];
            $user = $_POST['users_payout'];
            $amount = $_POST['amount_payout'];

            $PayOut = new \MangoPay\PayOut();
            $PayOut->AuthorId = $user;
            $PayOut->DebitedWalletID = $wallet;
            $PayOut->DebitedFunds = new \MangoPay\Money();
            $PayOut->DebitedFunds->Currency = "EUR";
            $PayOut->DebitedFunds->Amount = $amount;
            $PayOut->Fees = new \MangoPay\Money();
            $PayOut->Fees->Currency = "EUR";
            $PayOut->Fees->Amount = 1;
            $PayOut->PaymentType = "BANK_WIRE";
            $PayOut->MeanOfPaymentDetails = new \MangoPay\PayOutPaymentDetailsBankWire();
            $PayOut->MeanOfPaymentDetails->BankAccountId = '55516036';
            $result = $this->mangopay->PayOuts->Create($PayOut);

            return Redirect::to("/mangopay/sandbox")->withInput()->with('success', 'PayOut erfolgreich ausgeführt');

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function createRefund(){

        $PayInId = '55508845';
        $Refund = new \MangoPay\Refund();
        $Refund->AuthorId = '55498120';
        $Refund->DebitedFunds = new \MangoPay\Money();
        $Refund->DebitedFunds->Currency = "EUR";
        $Refund->DebitedFunds->Amount = 100;
        $Refund->Fees = new \MangoPay\Money();
        $Refund->Fees->Currency = "EUR";
        $Refund->Fees->Amount = 0;
        $result = $this->mangopay->PayIns->CreateRefund($PayInId, $Refund);

        return $result;
    }

    public function createPayIn(){

        try {

            $wallet = "55895227";
            $user = "55894537";
            $amount = "600";

            // create pay-in CARD DIRECT
            $payIn = new \MangoPay\PayIn();
            $payIn->CreditedWalletId = $wallet;
            $payIn->AuthorId = $user;
            $payIn->PaymentType = "CARD";
            $payIn->PaymentDetails = new \MangoPay\PayInPaymentDetailsCard();
            $payIn->PaymentDetails->CardType = "CB_VISA_MASTERCARD";
            $payIn->DebitedFunds = new \MangoPay\Money();
            $payIn->DebitedFunds->Amount = $amount;
            $payIn->DebitedFunds->Currency ="EUR";
            $payIn->Fees = new \MangoPay\Money();
            $payIn->Fees->Amount = 300;
            $payIn->Fees->Currency = "EUR";
            $payIn->ExecutionType = "WEB";
            $payIn->ExecutionDetails = new \MangoPay\PayInExecutionDetailsWeb();
            $payIn->ExecutionDetails->ReturnURL = "http://www.ws.mvp/en/mangopay/sandbox";
            $payIn->ExecutionDetails->Culture = "EN";

            $result = $this->mangopay->PayIns->Create($payIn);

            $test = $result->ExecutionDetails;
            return Redirect::to( $test->RedirectURL );

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function createUser() {
        try {

                // create user for payment
                $user = new MangoPay\UserNatural();

                if(isset($_POST['firstname'])){

                    $user->FirstName = $_POST['firstname'];
                    $user->LastName = $_POST['lastname'];
                    $user->Email = $_POST['email'];
                    $user->Birthday = time();
                    $user->Nationality = 'FR';
                    $user->CountryOfResidence = 'FR';
                    $user->Occupation = "Performer";
                    $user->IncomeRange = 3;
                    $createdUser = $this->mangopay->Users->Create($user);

                    return Redirect::to("/mangopay/sandbox")->withInput()->with('success', 'User erfolgreich angelegt');

                }else{
                    return Redirect::to("/mangopay/sandbox")->withInput()->with('error', 'Es ist ein Fehler aufgetreten!');
                }

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }



    }

    public function createLegalUser() {
        try {

            // create user for payment
            $user = new MangoPay\UserLegal();

            $user->LegalPersonType = \MangoPay\LegalPersonType::Business;
            $user->Name = "Company Name";
            $user->Email = "test@legal.de";
            $user->LegalRepresentativeFirstName = "Firstname";
            $user->LegalRepresentativeLastName = "Lastname";
            $user->LegalRepresentativeBirthday = time();
            $user->LegalRepresentativeNationality = "FR";
            $user->LegalRepresentativeCountryOfResidence = "FR";
            $createdPerformer = $this->mangopay->Users->Create($user);

            return Redirect::to("/mangopay/sandbox")->withInput()->with('success', 'User erfolgreich angelegt');


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


    public function createWallet() {
        try {

            if(isset($_POST['users']) && $_POST['users'] != ""){

                // create temporary wallet for user
                $wallet = new \MangoPay\Wallet();
                $wallet->Owners = array( '55576344' );
                $wallet->Currency = 'EUR';
                $wallet->Description = $_POST['desc_wallet'];
                $createdWallet = $this->mangopay->Wallets->Create($wallet);

                return Redirect::to("/mangopay/sandbox")->withInput()->with('success', 'Wallet erfolgreich angelegt');
                //return $createdWallet;

            }else{
                return Redirect::to("/mangopay/sandbox")->withInput()->with('error', 'Es ist ein Fehler aufgetreten!');
            }


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




}
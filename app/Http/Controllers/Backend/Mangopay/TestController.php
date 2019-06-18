<?php
namespace App\Http\Controllers\Backend\Mangopay;

use MangoPay, Redirect, App;
use App\Http\Controllers\Controller;

class TestController extends Controller
{

    /**
     * @var \MangoPay\MangoPayApi
     */
    private $mangopay;

    public function __construct(\MangoPay\MangoPayApi $mangopay) {

        $this->mangopay = $mangopay;

    }

    public function index() {

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


    public function createPayout(){

        $PayOut = new \MangoPay\PayOut();
        $PayOut->AuthorId = '55498018';
        $PayOut->DebitedWalletID = '55504604';
        $PayOut->DebitedFunds = new \MangoPay\Money();
        $PayOut->DebitedFunds->Currency = "EUR";
        $PayOut->DebitedFunds->Amount = 3000;
        $PayOut->Fees = new \MangoPay\Money();
        $PayOut->Fees->Currency = "EUR";
        $PayOut->Fees->Amount = 1;
        $PayOut->PaymentType = "BANK_WIRE";
        $PayOut->MeanOfPaymentDetails = new \MangoPay\PayOutPaymentDetailsBankWire();
        $PayOut->MeanOfPaymentDetails->BankAccountId = '55516036';
        $result = $this->mangopay->PayOuts->Create($PayOut);

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

    public function createPayIn($wallet, $user){

        // create pay-in CARD DIRECT
        $payIn = new \MangoPay\PayIn();
        //$payIn->CreditedWalletId = $createdWallet->Id;
        $payIn->CreditedWalletId = $wallet;
        //$payIn->AuthorId = $createdUser->Id;
        $payIn->AuthorId = $user;
        $payIn->PaymentType = "CARD";
        $payIn->PaymentDetails = new \MangoPay\PayInPaymentDetailsCard();
        $payIn->PaymentDetails->CardType = "CB_VISA_MASTERCARD";
        $payIn->DebitedFunds = new \MangoPay\Money();
        $payIn->DebitedFunds->Amount = $_SESSION['amount'];
        $payIn->DebitedFunds->Currency = $_SESSION['currency'];
        $payIn->Fees = new \MangoPay\Money();
        $payIn->Fees->Amount = 300;
        $payIn->Fees->Currency = $_SESSION['currency'];
        $payIn->ExecutionType = "WEB";
        $payIn->ExecutionDetails = new \MangoPay\PayInExecutionDetailsWeb();
        $payIn->ExecutionDetails->ReturnURL = "http".(isset($_SERVER['HTTPS']) ? "s" : null)."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."?stepId=".('2'+1);
        $payIn->ExecutionDetails->Culture = "EN";

        $result = $this->mangopay->PayIns->Create($payIn);


        return $result;

    }

    public function createUser() {

        // create user for payment
        $user = new MangoPay\UserNatural();
        $user->FirstName = 'John';
        $user->LastName = 'Smith';
        $user->Email = 'email1@domain.com';
        $user->Birthday = time();
        $user->Nationality = 'FR';
        $user->CountryOfResidence = 'FR';
        $user->Occupation = "programmer";
        $user->IncomeRange = 3;
        $createdUser = $this->mangopay->Users->Create($user);

        return $createdUser;

    }

    public function createWallet() {

        // create temporary wallet for user
        $wallet = new \MangoPay\Wallet();
        $wallet->Owners = array( '55498018' );
        $wallet->Currency = 'EUR';
        $wallet->Description = 'Temporary wallet for payment demo';
        $createdWallet = $this->mangopay->Wallets->Create($wallet);

        return $createdWallet;

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


    public function template() {

        $blade["locale"] = App::getLocale();
        return view('backend.mangopay.payline_form', compact('blade'));

    }

}
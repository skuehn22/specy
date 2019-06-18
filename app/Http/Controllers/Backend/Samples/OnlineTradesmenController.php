<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 11.10.2018
 * Time: 09:37
 */

namespace App\Http\Controllers\Backend\Samples;

// Libraries
use App, Auth, DB, Hash;
use MangoPay, Redirect, Request;
use App\DatabaseModels\ApplaudPerformers;
use App\DatabaseModels\ApplaudClients;
use App\DatabaseModels\ApplaudWalletsMango;
use App\DatabaseModels\ApplaudPayIn;
use App\DatabaseModels\ApplaudTracking;
use App\Http\Controllers\Controller;

class OnlineTradesmenController extends Controller
{

    /**
     * @var \MangoPay\MangoPayApi
     */
    private $mangopay;

    public function __construct(\MangoPay\MangoPayApi $mangopay) {

        $this->mangopay = $mangopay;

    }

    public function index() {


        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        if(isset($_GET['transactionId'])){
            $id = $_GET['transactionId'];
        }

        return view('backend.samples.onlinetradesmen.sandbox_onlinetradesmen', compact('blade', 'id'));

    }

    public function builderDashboard() {


        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        return view('backend.samples.onlinetradesmen.builder_dashboard', compact('blade'));

    }

    public function createOffer() {


        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        $hash = Hash::make("test");

        return view('backend.samples.onlinetradesmen.create-offer', compact('blade', 'hash'));

    }

    public function createTransaction() {

        $input = Request::all();

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        $performer = $this->getPerformerInfo($input['performer']);
        $client = $this->getClientInfo($input['client']);

        //check if already an performer with this email exists
        if($performer->mango_id_fk !=0){
            $mango_performer = $this->getMangoUser($performer);
        }else{
            $mango_performer = $this->createMangoLegalUser($performer);

            DB::table('applaud_performers')
                ->where('email', $performer->email)
                ->update(['mango_id_fk' => $mango_performer->Id]);
        }

        //check if already an client with this email exists
        if($client->mango_id_fk !=0){
            $mango_client = $this->getMangoUser($client);
        }else{
            $mango_client = $this->createMangoNaturalUser($client);

            DB::table('applaud_clients')
                ->where('email', $client->email)
                ->update(['mango_id_fk' => $mango_client->Id]);
        }

        //get wallet for performer and client
        $performer_wallet_id = $this->getMangoWallets($mango_performer->Id);
        $client_wallet_id = $this->getMangoWallets($mango_client->Id);

        //if there is no wallet create one
        if(!$performer_wallet_id){
            $performer_wallet = $this->createWallet($mango_performer->Id);
            $performer_wallet_id = $performer_wallet->Id;
            $wallet = new ApplaudWalletsMango();
            $wallet->id = $performer_wallet->Id;
            $wallet->performer_id_fk = $performer->id;
            $wallet->save();
        }

        //if there is no wallet create one
        if(!$client_wallet_id){
            $client_wallet = $this->createWallet($mango_client->Id);
            $client_wallet_id = $client_wallet->Id;
            $wallet = new ApplaudWalletsMango();
            $wallet->id = $client_wallet->Id;
            $wallet->client_id_fk = $client->id;
            $wallet->save();
        }

        $hash = $this->prepPayInCardWeb($mango_client->Id, $performer_wallet_id, $input['amount']);

        return $hash;

    }

    public function openTransaction($hash){

        $input = Request::all();
        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        $payIn = $this->createPayInCardWeb($hash);

        //track user action
        $tracking = new ApplaudTracking();
        $tracking->action=1;
        $tracking->save();

        return Redirect::to($payIn->RedirectURL);

    }

    public function clientCheckout($hash){

        $input = Request::all();
        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        //$payIn = $this->createPayInCardWeb($hash);

        //track user action
        $tracking = new ApplaudTracking();
        $tracking->action=1;
        $tracking->save();

        return view('backend.pilot_applaud.client-checkout', compact('blade'));

    }

    public function prepPayInCardWeb($author, $credited_wallet, $amount) {

        try {

            $hash = time();

            $payin = new ApplaudPayIn();
            $payin->hash = $hash;
            $payin->author_id = $author;
            $payin->credited_wallet = $credited_wallet;
            $payin->amount = $amount + ($amount * 0.08);
            $payin->payment_type = "CARD";
            $payin->execution_type = "WEB";
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

    public function createPayInCardWeb($hash) {

        try {


            $prepedPayIn = ApplaudPayIn::where("hash", "=", $hash)
                ->first();

            // create pay-in CARD DIRECT
            $payIn = new \MangoPay\PayIn();
            $payIn->CreditedWalletId = $prepedPayIn->credited_wallet;
            $payIn->AuthorId = $prepedPayIn->author_id;
            $payIn->PaymentType = "CARD";
            $payIn->PaymentDetails = new \MangoPay\PayInPaymentDetailsCard();
            $payIn->PaymentDetails->CardType = "CB_VISA_MASTERCARD";
            $payIn->DebitedFunds = new \MangoPay\Money();
            $payIn->DebitedFunds->Amount = $prepedPayIn->amount * 100;
            $payIn->DebitedFunds->Currency ="EUR";
            $payIn->Fees = new \MangoPay\Money();
            $payIn->Fees->Amount = 300;
            $payIn->Fees->Currency = "EUR";
            $payIn->ExecutionType = "WEB";
            $payIn->ExecutionDetails = new \MangoPay\PayInExecutionDetailsWeb();
            $payIn->ExecutionDetails->ReturnURL = "http://www.ws.mvp/en/applaud/secure/escrow/confirm";
            $payIn->ExecutionDetails->Culture = "EN";

            $result = $this->mangopay->PayIns->Create($payIn);

            $prepRedirect = $result->ExecutionDetails;

            return $prepRedirect;



        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

    }

    public function createMangoLegalUser($performer) {
        try {

            // create user for payment
            $user = new MangoPay\UserLegal();

            $user->LegalPersonType = \MangoPay\LegalPersonType::Business;
            $user->Name = $performer->company;
            $user->Email = $performer->email;
            $user->LegalRepresentativeFirstName = $performer->firstname;
            $user->LegalRepresentativeLastName =$performer->lastname;
            $user->LegalRepresentativeBirthday = time();
            $user->LegalRepresentativeNationality = "FR";
            $user->LegalRepresentativeCountryOfResidence = "FR";
            $createdPerformer = $this->mangopay->Users->Create($user);

        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

        return $createdPerformer;
    }

    public function createMangoNaturalUser($client) {
        try {

            // create user for payment

            $user = new MangoPay\UserNatural();
            $user->Email = $client->email;
            $user->FirstName = $client->firstname;
            $user->LastName = $client->lastname;
            $user->Birthday = time();
            $user->Nationality = "FR";
            $user->CountryOfResidence = "FR";
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

    public function createWallet($user) {
        try {

            // create temporary wallet for user
            $wallet = new \MangoPay\Wallet();
            $wallet->Owners = array( $user );
            $wallet->Currency = 'EUR';
            $wallet->Description = "MVP Description";
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

    public function getMangoUser($performer) {
        try {

            $mangoPerformer = $this->mangopay->Users->Get($performer->mango_id_fk);
            return $mangoPerformer;


        } catch (MangoPay\Libraries\ResponseException $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }
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

        if(isset($wallets[0]->Id)){
            return $wallets[0]->Id;
        }else{
            return false;
        }
    }

    public function getPerformerInfo($email) {

        $user = ApplaudPerformers::where("email", "=", $email)
            ->first();

        return  $user;

    }

    public function getClientInfo($email) {

        $user = ApplaudClients::where("email", "=", $email)
            ->first();

        return  $user;

    }

    public function getCardTypes() {

        $card_types[] = "CB_VISA_MASTERCARD";
        $card_types[] = "DINERS";
        $card_types[] = "MASTERPASS";
        $card_types[] = "MAESTRO";
        $card_types[] = "P24";

        return $card_types;

    }

}
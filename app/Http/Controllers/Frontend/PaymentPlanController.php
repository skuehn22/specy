<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 26.06.2018
 * Time: 14:08
 */

namespace App\Http\Controllers\Frontend;

// Libraries
use App, Redirect, Auth, DB, Input, Validator, Hash, Session;

use App\Http\Controllers\Controller;


use App\DatabaseModels\Clients;
use App\DatabaseModels\Plans;
use App\DatabaseModels\PlanDocs;
use App\DatabaseModels\UsersPaymentPlan;
use App\DatabaseModels\PlansMilestone;
use App\DatabaseModels\MangoPayout;
use App\DatabaseModels\Companies;
use App\DatabaseModels\CompaniesBank;
use App\DatabaseModels\CompaniesMangowallets;
use App\DatabaseModels\ClientsMangowallets;
use App\DatabaseModels\Users;
use App\Classes\MangoClass;
use App\Classes\MessagesClass;
use App\Classes\StateClass;
use App\Classes\CompanyClass;

class PaymentPlanController extends Controller
{

    /**
     * @var \MangoPay\MangoPayApi
     */
    private $mangopay;

    public function __construct(\MangoPay\MangoPayApi $mangopay) {

        $this->mangopay = $mangopay;

    }

    public function index($hash) {

        if(isset($_GET['protect']) && $_GET['protect'] == true){
            $protect = true;
            $login = true;
        }else{
            $login = false;
            $protect = false;
        }

        // needs a complete new methode -> not safe at all

        if(isset($_GET['login'])) {
            $loggedIn = true;
        }else{
            $loggedIn = false;
        }

        if (isset($_GET['transactionId'])) {
            $loggedIn = true;
        }

        $blade["locale"] = App::getLocale();

        //get all plan details for the normal payment plan view
        $query = DB::table('projects_plans');
        $query->join('clients', 'projects_plans.clients_id_fk', '=', 'clients.id');
        $query->where('projects_plans.hash', '=', $hash);
        $query->select('clients.firstname', 'clients.lastname', 'clients.email', 'clients.firstname', 'clients.address1', 'clients.city', 'clients.address2', 'projects_plans.*');
        $plan = $query->first();

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();

        if($plan->delete ==1){


            return view('frontend.clients.payment-plan-deleted', compact('blade', 'company', 'plan'));

        }else{


            $user = App\DatabaseModels\Users::where("id", "=", $company->users_fk)
                ->first();

            $docs = PlanDocs::where("plan_id_fk", "=", $plan->id)
                ->where("delete", "=", "0")
                ->get();




                //only if client comes back from mangopay
                if (isset($_GET['transactionId'])) {

                    if (strpos($_GET['transactionId'], 'bank') == false) {


                        //if client comes from mangopay they will habe an transaction id
                        $transactionId = $_GET['transactionId'];

                        //get result of the payin made by client
                        $mango_obj = new MangoClass($this->mangopay);
                        $payinResult = $mango_obj->getPayInCardWeb($transactionId);

                        //update the result of the payin in intern DB
                        $payIn = App\DatabaseModels\MangoPayin::where("mango_id", "=", $transactionId)
                            ->first();

                        $payIn->state = $payinResult->Status;
                        $payIn->result_code = $payinResult->ResultCode;
                        $payIn->result_message = $payinResult->ResultMessage;
                        $payIn->save();

                        $milestone = PlansMilestone::where("id", "=", $payIn->milestone_id_fk)
                            ->first();

                        //if payment was successful update the paystatus of our intern DB
                        if ($payinResult->Status == "SUCCEEDED") {
                            $milestone->paystatus = 2;
                            $milestone->save();

                            //check if the money can be realesd later or if things are missing on the freelancer site
                            $company_obj = new CompanyClass();
                            $status = $company_obj->checkMangoRequirements($company);

                            $kyc = $this->checkKYC($company);
                            if (!$kyc) {
                                $status['kyc'] = 1;
                            }

                            $i = 0;

                            $requirements = "<p>Please remember to add the following things in your account settings:</p>";

                            if (isset($status['kyc']) && $status['kyc'] == 1) {
                                $requirements .= "<p>Your company verification</p>";
                                $i = 1;
                            }

                            if (isset($status['bank']) && $status['bank'] == 1) {
                                $requirements .= "<p>Your bank details</p>";
                                $i = 1;
                            }

                            if (isset($status['legal']) && $status['legal'] == 1) {
                                $requirements .= "<p>Your personal details</p>";
                                $i = 1;
                            }

                            if ($i == 0) {
                                $requirements = "";
                            } else {
                                $requirements .= "<p><strong>Without this information, we cannot release your payment!</strong></p>";
                            }

                            //check end

                            $msg_obj = new MessagesClass();
                            $result = $msg_obj->payInSucceeded($milestone, $plan, $user, $requirements);

                        } else {

                            Session::flash('error', 'An error has occurred- ' . $payinResult->ResultMessage);

                        }

                }
            }



            $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
                ->OrderBy('order', 'asc')
                ->get();

            foreach ($milestones as $milestone){
                $statusObj = new StateClass();
                $status = $statusObj->milestonesClient($milestone->paystatus);
                $milestone->statusTxt = $status['state'];
                $milestone->color = $status['color'];
                $milestone->info = $status['info'];
            }

            $login = true;

            return view('frontend.clients.payment-plan', compact('blade', 'plan', 'user', 'company', 'milestones', 'docs', 'login', 'hash', 'protect', 'loggedIn'));

        }

    }

    public function loadPreview($id) {

        $blade["locale"] = App::getLocale();


        $plan = Plans::where("id", "=", $id)
            ->first();

        return Redirect::to($blade["locale"]."/payment-plan/preview/".$plan->hash)->withInput()->with('success', 'Your payment plan has been created!');

    }

    public function preview($hash) {

        $blade["locale"] = App::getLocale();

        $user = Auth::user();
        $preview = true;

        $query = DB::table('projects_plans');
        $query->join('clients', 'projects_plans.clients_id_fk', '=', 'clients.id');
        $query->where('projects_plans.hash', '=', $hash );
        $query->select('clients.firstname', 'clients.lastname', 'clients.email', 'clients.firstname', 'clients.address1', 'clients.city', 'clients.address2', 'projects_plans.*');
        $plan = $query->first();

        $company = Companies::where("id", "=", $user->service_provider_fk)
            ->first();

        if(!isset($plan)){
            $plan = Plans::where("hash", "=", $hash)
                ->first();
        }

        $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
            ->OrderBy('order', 'asc')
            ->get();

        return view('frontend.clients.payment-plan', compact('blade', 'plan', 'user', 'company', 'milestones', 'preview'));
    }

    public function payCC($hash) {

        $blade["locale"] = App::getLocale();
      

        $plan = Plans::where("hash", "=", $hash)
            ->first();

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();



        $milestone = PlansMilestone::where("id", "=", $_POST['milestone_to_pay'])
            ->first();

        $client = Clients::where("id", "=", $plan->clients_id_fk)
            ->first();

        $mango_obj = new MangoClass($this->mangopay);
        $url=   $mango_obj->createTransaction($company, $client, $milestone, $hash);


        if(isset($url->RedirectURL)){
            return Redirect::to($url->RedirectURL);
        }else{
            return redirect()->back()->withInput()->with('error', 'Error. Please try again or contact trustfy.io.');
        }

    }





    public function checkKYC($company){

        $mango_obj = new MangoClass($this->mangopay);

        if($company->mango_id){
            $mangoUser = $mango_obj->getUser($company->mango_id);

            if($mangoUser->KYCLevel=="REGULAR"){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function payBank($hash) {

        $blade["locale"] = App::getLocale();


        $plan = Plans::where("hash", "=", $hash)
            ->first();

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();

        $milestone = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
            ->first();


        return view('frontend.clients.bank-transfer', compact('blade', 'plan', 'user', 'company', 'milestone'));


    }

    public function releaseMilestone($id) {

        $milestone = PlansMilestone::where("id", "=", $id)
            ->first();

        //get all plan details for the normal payment plan view
        $query = DB::table('projects_plans_milestones');
        $query->join('projects_plans', 'projects_plans.id', '=', 'projects_plans_milestones.projects_plans_id_fk');
        $query->join('companies', 'projects_plans.service_provider_fk', '=', 'companies.id');
        //$query->join('companies_mangowallets', 'companies.id', '=', 'companies_mangowallets.performer_id_fk');
        //$query->join('companies_bank', 'companies.id', '=', 'companies_mangowallets.performer_id_fk');
        $query->where('projects_plans_milestones.id', '=', $id);
        $query->select('companies.mango_id AS author', 'projects_plans.*', 'projects_plans.id AS planId', 'projects_plans.clients_id_fk AS clientId') ;
        $plan = $query->first();

        $user = Users::where("service_provider_fk", "=", $plan->service_provider_fk)
            ->first();

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();

        $bank = CompaniesBank::where("service_provider_fk", "=", $plan->service_provider_fk)
            ->first();


        $client = Clients::where("id", "=", $plan->clientId)
            ->first();

        $client_wallet = ClientsMangowallets::where("client_id_fk", "=", $client->id)
            ->where("currency", "=", $milestone->currency)
            ->first();

        //check if there is a wallet with the right currency
        $wallet = CompaniesMangowallets::where("performer_id_fk", "=", $plan->service_provider_fk)
            ->where("currency", "=", $milestone->currency)
            ->first();

        //if there is no wallet with the right currency create on and save
        if(empty($wallet)){

            $mango_obj = new MangoClass($this->mangopay);
            $mangoWallet = $mango_obj->createWallet($company->mango_id, $milestone->currency);

            $wallet = new CompaniesMangowallets();
            $wallet->id = $mangoWallet->Id;
            $wallet->performer_id_fk = $company->id;
            $wallet->currency = $milestone->currency;
            $wallet->save();

        }


        //make transfer of the money: from client wallet to freelancer wallet
        $mango_obj = new MangoClass($this->mangopay);
        $transfer = $mango_obj->createTransfer($client->mango_id, $milestone, $client_wallet, $wallet);


        if(!empty($bank) && $bank->mango_bank_id){

            $mango_obj = new MangoClass($this->mangopay);
            $mangoUser = $mango_obj->getUser($company->mango_id);

            if($mangoUser->KYCLevel=="REGULAR"){

                $mango_obj = new MangoClass($this->mangopay);
                $payOutResult = $mango_obj->createPayOut($company->mango_id, $milestone, $bank, $wallet);

                $payout = new MangoPayout();
                $payout->status = $payOutResult->Status;
                $payout->company_id_fk = $plan->service_provider_fk;
                $payout->mango_id = $payOutResult->Id;
                $payout->milestone_id_fk = $id;
                $payout->save();

                if($payOutResult->Status == "CREATED"){

                    $subject = "Trustfy - Pay-out confirmation";
                    $msg_obj = new MessagesClass();
                    $msg_obj->payOutCreated($subject, $user->email, $payout, $plan->planId);

                    $milestone->paystatus = 3;
                    $milestone->save();

                }

            }else{

                $client = Clients::where("id", "=", $plan->clientId)
                    ->first();

                $subject = "Trustfy - Payment released";
                $data['content'] =  "<p>Great news! <br>".$client->firstname." ".$client->lastname." has released a payment for ".$milestone->name."<br></p>";
                $data['content'] .= "<p><strong>Complete the verification</strong> and your money will be on its way!<br> <br></p>";

                $data['content'] .='
            <p>
               <a href="https://www.trustfy.io/login" style="background-color: #19A3B8; text-decoration: none; border-color: #19A3B8; padding: 10px; color:#fff; font-size: 14px; border-radius: .25rem; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out" class="btn btn-primary" target="_blank">Add Account Details</a>                  
            </p>';

                $msg_obj = new MessagesClass();
                $msg_obj->sendStandardMail($subject, $data, $user->email, null, null);

                $milestone->paystatus = 9;
                $milestone->save();

            }


        }else{

            $client = Clients::where("id", "=", $plan->clientId)
                ->first();

            $subject = "Trustfy - Payment released";
            $data['content'] =  "<p>Great news! <br>".$client->firstname." ".$client->lastname." has released a payment for ".$milestone->name."<br></p>";

            if($company->mango_id != 0){
                $mango_obj = new MangoClass($this->mangopay);
                $mangoUser = $mango_obj->getUser($company->mango_id);
            }



            if(isset($mangoUser) && $mangoUser->KYCLevel=="REGULAR"){
                $data['content'] .= "<p>Just <strong>add your bank account details</strong> and your money will be on its way!<br> <br></p>";
                $milestone->paystatus = 8;
            }else{
                $data['content'] .= "<p>Just <strong>add your bank account details and complete the verification</strong> and your money will be on its way!<br> <br></p>";
                $milestone->paystatus = 10;
            }


            $data['content'] .='
            <p>
               <a href="https://www.trustfy.io/login" style="background-color: #19A3B8; text-decoration: none; border-color: #19A3B8; padding: 10px; color:#fff; font-size: 14px; border-radius: .25rem; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out" class="btn btn-primary" target="_blank">Add Account Details</a>                  
            </p>';

            $msg_obj = new MessagesClass();
            $msg_obj->sendStandardMail($subject, $data, $user->email, null, null);


            $milestone->save();

        }

        return Redirect::to("/payment-plan/".$plan->hash)->withInput()->with('success', 'Money released!');

    }

    public function setProtection() {

        $ll = App::getLocale();
        $users = new UsersPaymentPlan;
        $users->plan_hash = $_GET["hash"];
        $users->email = $_GET["email"];
        $users->password =  $_GET["password"];
        $users->active = "0";
        $users->role = 4;
        $users->save();

        $plan = Plans::where("hash", "=", $_GET["hash"])
            ->first();

        //set hide to hide the modal which ask for setting up a protection
        $plan->protection = "hide";
        $plan->protection_user = $users->id;
        $plan->save();


        $subject= "Trustfy - Plan Protection";
        $data['content'] = "<h3>Information to your plan protection</h3>Your Plan Protection: <br>".$_GET["email"]."<br> Passwort:".$_GET["password"];

        $msg_obj = new MessagesClass();
        $msg_obj->sendStandardMail($subject, $data, $_GET["email"], null, null);

        $result = self::login();

        if($result){
            return response()->json(['success' => true, 'msg' => 'Logged In']);
        }else{
            return response()->json(['success' => false, 'msg' => 'Unknown Login Data']);
        }

    }

    public function loginPlan() {

       $result = self::login();

        if($result){
            return response()->json(['success' => true, 'msg' => $result]);
        }else{
            return response()->json(['success' => false, 'msg' => 'Unknown Login Data.']);
        }

    }

    public function login() {

        $data = Input::all();

        $user = UsersPaymentPlan::where("plan_hash", "=", $data["hash"])
            ->first();


        if(empty($user)){

            $plan = Plan::where("hash", "=", $data["hash"])
                ->first();

            $plan->protection = "show";
            $plan->save();

            return false;

        }else{

            if(isset($data["password-login"])){
                if($user->email == $data["email-login"] && $user->password == $data["password-login"]){

                    $user->user_hash = Hash::make($data["password"]);
                    $user->save();

                    return true;
                }else{
                    return false;
                }
            }else{
                if($user->email == $data["email"] && $user->password == $data["password"]){

                    $user->user_hash = Hash::make($data["password"]);
                    $user->save();


                    return true;

                    return $user->user_hash;
                }else{
                    return false;
                }
            }

        }

    }

    public function loadBank($hash){

        $blade["locale"] = App::getLocale();

        $plan = Plans::where("hash", "=", $hash)
            ->first();

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();

        $milestone = PlansMilestone::where("id", "=", $_GET['val'])
            ->first();


        return view('frontend.clients.bank-transfer', compact('blade', 'plan', 'user', 'company', 'milestone'));


    }

    public function completedBank($hash){

        $blade["locale"] = App::getLocale();

        $plan = Plans::where("hash", "=", $hash)
            ->first();

        $client = Clients::where("id", "=", $plan->clients_id_fk)
            ->first();

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();

        $milestone = PlansMilestone::where("id", "=", $_GET['val'])
            ->where("projects_plans_id_fk", "=", $plan->id)
            ->first();

        $milestone->payment_method = 1;
        $milestone->paystatus = 5;
        $milestone->save();

        $subject= "Trustfy Payments";
        $data['content'] = "<h3>Thank you for your payment!</h3>";
        $data['content'] .= "<p>You have marked the bank transfer for: \"".$milestone->name."\" as complete.</p>";
        $data['content'] .= "<p>If you have not made the transfer yet, please <br>transfer ".$milestone->currency." ".number_format($milestone->amount, 2, '.', ',')." to the following account:</p>";

        $data['content'] .=

            "<p>

                <span>Name: </span><span>Trustfy Client Account</span><br>
                <span>IBAN: </span><span>IE95 AIBK 9310 7128 1910 54</span><br>
                 <span>BIC: </span><span>AIBKIE2D</span><br>
                  <span>Reference: </span><span>C-{$milestone->id}-{$milestone->projects_plans_id_fk}</span><br>
        </p>";


        $changeUrl = env("APP_URL") . "/" . App::getLocale() . "/payment-plan/change-methode/".$plan->hash."?val=".$_GET['val'];
        $data['content'] .= "<a href=".$changeUrl. " style='color: #949494; text-decoration: underline;'>Change Payment Method</a>";


        $data['content'] .= "<p><br>Your money will be held in a secure client account<br>for the duration of the project. <br>Simply click \"release funds\" when the work is done!</p>";

        $msg_obj = new MessagesClass();
        $msg_obj->sendStandardMail($subject, $data, $client->email, $company->logo, null);

        $user = App\DatabaseModels\Users::where("id", "=", $company->users_fk)
            ->first();

        $planUrl = env("APP_URL") . "/" . App::getLocale() . "/payment-plan/".$plan->hash;

        $subject= "Trustfy Payments - Payment initiated";
        $data['content'] =  "<p>Great news! <br>".$client->firstname." ".$client->lastname." has initated a bank transfer:</p>";
        $data['content'] .= "<p>Project: ".$plan->name."</p>";
        $data['content'] .= "<p>Milestone: ".$milestone->name."</p>";
        $data['content'] .= "  <p>Amount: ".$milestone->currency." ".number_format($milestone->amount, 2, ',', ' ')."</p>";
        $data['content'] .= "<p>We will let you know when the money arrives.</p>";

        $data['content'] .='

            <p><br><br>
             <a href="'.$planUrl.'" class="btn btn-primary"  style="background-color: #19A3B8; text-decoration: none; border-color: #19A3B8; padding: 10px; color:#fff; font-size: 14px; border-radius: .25rem; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out" target="_blank">View Plan</a>
            </p>
           
        ';


        $requirements = $this->checkRequirements($company);

        $msg_obj->sendStandardMail($subject, $data, $user->email, null, $requirements);

        //checks from which point the payment was clicked as done
        if(isset($_GET['typ'])){
            return Redirect::to("/payment-plan/".$plan->hash)->withInput()->with('success', 'Payment status updated.');
        }else{
            return response()->json(['success' => true, 'msg' => 'Bank transfer pending']);
        }

    }


    public function remindBank($hash){

        $blade["locale"] = App::getLocale();

        $plan = Plans::where("hash", "=", $hash)
            ->first();

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();

        $client = Clients::where("id", "=", $plan->clients_id_fk)
            ->first();

        $milestone = PlansMilestone::where("id", "=", $_GET['val'])
            ->where("projects_plans_id_fk", "=", $plan->id)
            ->first();

        $milestone->payment_method = 1;
        $milestone->paystatus = 6;
        $milestone->save();

        $planUrl = env("APP_URL") . "/" . App::getLocale() . "/payment-plan/bank-completed/".$plan->hash."?typ=mail&val=".$_GET['val'];
        $changeUrl = env("APP_URL") . "/" . App::getLocale() . "/payment-plan/change-methode/".$plan->hash."?typ=mail&val=".$_GET['val'];

        $subject= "Payment reminder for ".$milestone->name;
        $data['content'] = "<p>Hello ".$client->firstname." ".$client->lastname.",</p>";
        $data['content'] .= "<p>This is a friendly reminder to make a payment for: \"".$milestone->name."\".</p>";
        $data['content'] .= "<p>If you have not made the transfer yet, please transfer". $milestone->currency ." ".number_format($milestone->amount, 2, '.', ',')." to the following account:</p>";

        $data['content'] .=

            "<p>

                <span>Name: </span><span>Trustfy Client Account</span><br>
                <span>IBAN: </span><span>IE95 AIBK 9310 7128 1910 54</span><br>
                 <span>BIC: </span><span>AIBKIE2D</span><br>
                  <span>Reference: </span><span>C-{$milestone->id}-{$milestone->projects_plans_id_fk}</span><br>
</p>";

        $data['content'] .= "<p><strong>Once the transfer is complete, press the transfer complete button and we will not send you further reminders!</strong><br><br><br></p>";

        $data['content'] .='


        <p>
            <a href="'.$planUrl.'"  style="background-color: #19A3B8; text-decoration: none; border-color: #19A3B8; padding: 10px; color:#fff; font-size: 14px; border-radius: .25rem; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out" target="_blank" class="btn btn-primary">Mark Transfer Complete</a>
        </p>
        
        ';

        $data['content'] .= "<br><br><a href=".$changeUrl." style='color: #aaa; text-decoration: underline;'>Change Payment Method</a>";


        $msg_obj = new MessagesClass();
        $msg_obj->sendStandardMail($subject, $data, $client->email, $company->logo, null);

        return response()->json(['success' => true, 'msg' => 'Bank transfer pending']);

    }

    public function changeMethode($hash){

        $blade["locale"] = App::getLocale();

        $plan = Plans::where("hash", "=", $hash)
            ->first();

        $milestone = PlansMilestone::where("id", "=", $_GET['val'])
            ->where("projects_plans_id_fk", "=", $plan->id)
            ->first();

        if($milestone->paystatus == 5 || $milestone->paystatus == 6){

            $milestone->paystatus = 0;
            $milestone->save();

            return Redirect::to("/payment-plan/".$plan->hash)->withInput()->with('success', 'Your payment method has been reset, just choose a payment method below.');
        }else{
            return Redirect::to("/payment-plan/".$plan->hash)->withInput()->with('erroe', 'You can not change the payment method anymore');
        }
    }


    public function checkRequirements($company){

        //check if the money can be realesd later or if things are missing on the freelancer site
        $company_obj = new CompanyClass();
        $status = $company_obj->checkMangoRequirements($company);

        $kyc = $this->checkKYC($company);
        if(!$kyc){
            $status['kyc'] = 1;
        }

        $i = 0;

        $requirements = "<p>Please remember to add the following things in your account settings:</p>";

        if(isset($status['kyc']) && $status['kyc'] == 1){
            $requirements.= "<p>Your company verification</p>";
            $i = 1;
        }

        if(isset($status['bank']) && $status['bank'] == 1){
            $requirements.= "<p>Your bank details</p>";
            $i = 1;
        }

        if(isset($status['legal']) && $status['legal'] == 1){
            $requirements.= "<p>Your personal details</p>";
            $i = 1;
        }

        if($i == 0){
            $requirements = "";
        }else{
            $requirements.= "<p><strong>Without this information, we cannot release your payment!</strong></p>";
        }

        return $requirements;
    }


}
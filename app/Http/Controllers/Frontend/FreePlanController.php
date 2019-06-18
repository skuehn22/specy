<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 13.05.2019
 * Time: 11:15
 */

namespace App\Http\Controllers\Frontend;

// Libraries
use App, Redirect, Auth, DB, Input, Validator, Hash, Session, Request, Mail, DateTime, Carbon;

use App\Http\Controllers\Controller;

use App\Classes\UsersClass;
use App\DatabaseModels\Clients;
use App\DatabaseModels\Plans;
use App\DatabaseModels\PlanDocs;
use App\DatabaseModels\PlansTypes;
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



class FreePlanController extends Controller
{

    function create(){

        $blade["locale"] = App::getLocale();
        $types = PlansTypes::lists("name", "id");

        if(isset($_POST['freelancer'])){
            $type = $_POST['freelancer'];
            $amount = $_POST['amount'];
            $cur = $_POST['cur'];
            $plantype = $_POST['type'];
        }



        return view('frontend.plan', compact('blade', 'types', 'company', 'plan', 'type', 'amount', 'cur', 'plantype'));
    }

    function edit(){

        $blade["locale"] = App::getLocale();
        $types = PlansTypes::lists("name", "id");

        $plan = Plans::where("hash", "=", $_GET['hash'])->first();
        $company = Companies::where("id", "=", $plan->service_provider_fk)->first();
        $client = Clients::where("id", "=", $plan->clients_id_fk)->first();

        $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
            ->where('delete', '=', '0')
            ->OrderBy('order', 'asc')
            ->get();


        $user = Users::where("service_provider_fk", "=", $company->id)->first();


        return view('frontend.plan', compact('client', 'blade', 'types', 'company', 'plan', 'type', 'amount', 'cur', 'plantype', 'milestones', 'user'));

    }

    public function getPlanByTyp(){

        $input = Request::all();

        if(isset($input['typedit'])){

            $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $input['typedit'])
                ->first();

            if(isset($milestones->typ) && $milestones->typ == 1){
                return view('frontend.plan_deposit', compact('blade', 'clients', 'plan', 'milestones'));
            }else{
                return view('frontend.plan_milestones', compact('blade', 'clients', 'plan', 'milestones'));
            }

        }else{

            if(isset($input['typ']) && $input['typ'] == 1){
                return view('frontend.plan_deposit', compact('blade', 'clients', 'plan'));
            }else{
                return view('frontend.plan_milestones', compact('blade', 'clients', 'plan'));
            }

        }

    }

    public function save() {

        $blade["locale"] = App::getLocale();
        $input = Request::all();

        if(isset($_POST["hash"]) && $_POST["hash"]!=''){

            $plan = Plans::where("hash", "=", $_POST['hash'])->first();

            $company = Companies::where("id", "=", $plan->service_provider_fk)->first();
            $company->firstname = $input['name_freelancer'];
            $company->name = $input['business'];
            $company->save();

            $user = Users::where("service_provider_fk", "=", $company->id)->first();

            $clients = new Clients();
            $clients->email = $input['client-email'];
            $clients->save();

            $plan->clients_id_fk = $clients->id;

            $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
                ->OrderBy('order', 'asc')
                ->get();

            foreach ($milestones as $milestone){

                $milestone->delete = 1;
                $milestone->save();

            }

        }else{

            if(isset($_POST['radio-new']) && $_POST['radio-new'] == 1){


                $user = Users::where("email", "=", $_POST['email'])->first();
                $hasher = app('hash');

                if ($hasher->check($_POST['password'], $user->password)) {

                    $user = Users::where("email", "=", $_POST['email'])->first();
                    $company = Companies::where("id", "=", $user->service_provider_fk)->first();

                    $clients = new Clients();
                    $clients->email = $input['client-email'];
                    $clients->save();

                    $plan = new Plans();
                    $plan->clients_id_fk = $clients->id;

                    $plan->service_provider_fk = $company->id;

                    if(isset($input['title']))
                        $plan->name = $input['title'];


                    $plan->date = date("Y-m-d");

                    if(isset($input['typ']))
                        $plan->typ = $input['typ'];

                    if(isset($input['comment']))
                        $plan->comment = nl2br($input['comment']);

                    if($plan->state < 2){
                        $plan->state = 0;
                    }

                    $plan->hidden = 0;
                    //$plan->hash = Hash::make(time());
                    $plan->hash = time();
                    $plan->save();


                }else{
                    return back()->withInput()->with('error', 'Email and password do not match');
                }

            }else{

                //$user = Users::where("email", "=", $_POST['email'])->first();

                $tmp = rand(100, 10000);
                $tmp.='@trustfy.io';

                $usersObj = new UsersClass();
                $response = $usersObj->saveTmpUser($_POST, $tmp);

                if($response == false){
                    return back()->withInput()->with('error', 'E-Mail already taken.');
                }else{


                    $user = Users::where("email", "=", $tmp)->first();
                    //$user = Users::where("email", "=", "sebastian@trustfy.io")->first();
                    //$user->active=1;

                    $company = new Companies();
                    $company->users_fk = $user->id;
                    $company->firstname = $input['name_freelancer'];
                    $company->name = $input['business'];
                    $company->save();

                    $user->service_provider_fk= $company->id;
                    $user->save();
                }

                $clients = new Clients();
                $clients->email = $input['client-email'];
                $clients->save();

                $plan = new Plans();
                $plan->clients_id_fk = $clients->id;

                $plan->service_provider_fk = $company->id;

                if(isset($input['title']))
                    $plan->name = $input['title'];


                $plan->date = date("Y-m-d");

                if(isset($input['typ']))
                    $plan->typ = $input['typ'];

                if(isset($input['comment']))
                    $plan->comment = nl2br($input['comment']);

                if($plan->state < 2){
                    $plan->state = 0;
                }

                $plan->hidden = 0;
                //$plan->hash = Hash::make(time());
                $plan->hash = time();
                $plan->save();



            }



        }


        //1 = Single Deposit
        if($input['typ'] == 1){

            $milestone = new PlansMilestone();
            $milestone->projects_plans_id_fk = $plan->id;


            if(isset($input['title-milestone'])){
                $milestone->name = $input['title-milestone'];
            }

            if(isset($input['desc-milestone'])){
                $milestone->desc = $input['desc-milestone'];
            }

            if(isset($input['single-amount'])){
                $milestone->amount = str_replace(',', '', $input['single-amount']);
            }

            if(isset($input['currency'])){
                $milestone->currency = $input['currency'];
            }



            $milestone->typ = $input['typ'];

            if(isset($input['pay-due']) && $input['pay-due'] == 3){

                $pieces = explode("/", $input['due-date']);

                $milestone->due_at = $pieces['1']."/".$pieces['0']."/".$pieces['2'];
            }


            $milestone->credit_card = 1;
            $milestone->bank_transfer = 1;

            /*
            if(isset($input['cc']) && $input['cc']=="true"){
                $milestone->credit_card = 1;
            }else{
                $milestone->credit_card = 0;
            }

            if(isset($input['bt']) && $input['bt']=="true"){
                $milestone->bank_transfer = 1;
            }else{
                $milestone->bank_transfer = 0;
            }
            */

            $milestone->save();


        }else{

            foreach($input['name'] as $key => $value){

                $milestone = new PlansMilestone();
                $milestone->projects_plans_id_fk = $plan->id;
                $milestone->order = $key+1;
                $milestone->typ = 2;
                $milestone->name = $value;
                $milestone->amount = $input['amount'][$key];
                $milestone->currency = $input['currency'][$key];
                $milestone->desc = $input['description'][$key];
                $pieces = explode("/", $input['due_date'][$key]);
                $milestone->due_at = $pieces['1']."/".$pieces['0']."/".$pieces['2'];


                /*
                if(isset($input['cc']) && $input['cc']=="true"){
                    $milestone->credit_card = 1;
                }else{
                    $milestone->credit_card = 0;
                }

                if(isset($input['bt']) && $input['bt']=="true"){
                    $milestone->bank_transfer = 1;
                }else{
                    $milestone->bank_transfer = 0;
                }
                */

                $milestone->credit_card = 1;
                $milestone->bank_transfer = 1;

                $milestone->save();
            }
        }



        $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
            ->where('delete', '=', '0')
            ->OrderBy('order', 'asc')
            ->get();





        //$this->send($user, $plan, $clients);

        //return back()->withInput()->with('success', 'The Payment Pan has been sent to your customer. You can log in <a href="/login" style="font-size: 12px; text-decoration: underline;">here</a> and manage the plan.');

        return view('frontend.clients.payment-plan-preview-homepage', compact('blade', 'plan', 'user', 'company', 'milestones', 'docs', 'hash'));


    }




    public function send() {


        $plan = Plans::where("hash", "=", $_GET['hash'])->first();
        $company = Companies::where("id", "=", $plan->service_provider_fk)->first();
        $clients = Clients::where("id", "=", $plan->clients_id_fk)->first();
        $user = App\DatabaseModels\Users::where("id", "=", $company->users_fk)
            ->first();

        $user->email=$user->tmp_mail;
        $user->active=1;
        $user->save();

        $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
            ->OrderBy('order', 'asc')
            ->get();

        $lang = App::getLocale();
        $input = Request::all();

        $plan = Plans::where("id", "=", $plan->id)
            ->first();

        if($plan->state == 2){

            return response()->json([
                'message'   => 'Your Payment was already sent earlier.'

            ]);

        }else{
            $plan->state =  1;
            $plan->save();

            $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
                ->first();

            $client = Clients::where("id", "=", $clients->id)
                ->first();

            //$company = App\DatabaseModels\Companies::where("id", "=", $user->service_provider_fk)
              //  ->first();

            $to = $client->email;

            //$mango_obj = new MangoClass($this->mangopay);
            //$url=   $mango_obj->createTransaction($company, $client, $input['single-amount']);

            Mail::send('emails.homepage_plan', compact('data', 'client', 'company', 'user', 'plan', 'lang', 'milestones'), function ($message) use ($client, $milestones, $user, $to) {
                $message->from($user->email, $user->firstname." ".$user->lastname);
                $message->to($to);
                $message->subject("Trustfy - Payment Plan");
            });



            $subject = "Startseite: Payment Plan";

            Mail::send('emails.homepage_plan', compact('data', 'client', 'company', 'user', 'plan', 'lang', 'milestones'), function ($message) use ($subject, $milestones, $client, $user) {
                $message->from($user->email, $user->firstname." ".$user->lastname);
                $message->subject($subject);
                $message->to('bcc@trustfy.io');
            });


            $subject = "Welcome to Trustfy";
            $msg_obj = new MessagesClass();
            $msg_obj->welcomeFreePlan($user, $subject, $client);
            $blade["locale"] = App::getLocale();
            $types = PlansTypes::lists("name", "id");
            $msg_success = "The Payment Pan has been sent to your customer. You can log in <a href=\"/login\" style=\"font-size: 12px; text-decoration: underline;\">here</a> and manage the plan.";

            return view('frontend.plan', compact('blade', 'types', 'company', 'plan', 'type', 'amount', 'cur', 'plantype', 'msg_success'));

        }

    }


    function loadPreview(Request $request){


        $plan = self::save();

        $blade["locale"] = App::getLocale();

        //get all plan details for the normal payment plan view
        /*
        $query = DB::table('projects_plans');
        $query->join('clients', 'projects_plans.clients_id_fk', '=', 'clients.id');
        $query->where('projects_plans.id', '=', $id);
        $query->select('clients.firstname', 'clients.lastname', 'clients.email', 'clients.firstname', 'clients.address1', 'clients.city', 'clients.address2', 'projects_plans.*');
        $plan = $query->first();
        */

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();

        $user = App\DatabaseModels\Users::where("id", "=", $company->users_fk)
            ->first();

        /*
        $docs = PlanDocs::where("plan_id_fk", "=", $plan->id)
            ->where('delete', '=', '0' )
            ->get();
        */

        $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
            ->OrderBy('order', 'asc')
            ->get();

        $hash = $plan->hash;

        return view('frontend.clients.payment-plan-preview', compact('blade', 'plan', 'user', 'company', 'milestones', 'docs', 'hash'));


    }

    function checkEmail(){

        $user = App\DatabaseModels\Users::where("email", "=", $_GET['email'])
            ->first();

        if($user){
            return response()->json([
                'message'   => 'Email already taken.'

            ]);
        }else{
            return response()->json([
                'message'   => ''

            ]);
        }

    }


}
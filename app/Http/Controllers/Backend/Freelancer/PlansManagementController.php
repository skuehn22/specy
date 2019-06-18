<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 21.11.2018
 * Time: 16:42
 */

namespace App\Http\Controllers\Backend\Freelancer;

// Libraries
use App, Auth, Request, Redirect, Form, DB, MangoPay, Mail, Hash, Session, Lang;

use App\Http\Controllers\Controller;
use App\DatabaseModels\Projects;
use App\DatabaseModels\PlansTypes;
use App\DatabaseModels\Clients;
use App\DatabaseModels\Plans;
use App\Classes\StateClass;
use App\DatabaseModels\PlanDocs;
use App\DatabaseModels\PlansMilestone;
use App\DatabaseModels\Companies;
use App\DatabaseModels\Countries;

use App\Classes\MessagesClass;
use Faker\Provider\Company;

class PlansManagementController extends Controller
{

    /**
     * @var \MangoPay\MangoPayApi
     */
    private $mangopay;

    public function __construct(\MangoPay\MangoPayApi $mangopay) {

        $this->mangopay = $mangopay;

    }

    public function index() {

        if (Auth::check()) {

        $blade["ll"] = App::getLocale();
        $blade["user"] = Auth::user();

        $query = DB::table('projects_plans');
        $query->join('clients', 'projects_plans.clients_id_fk', '=', 'clients.id');
        $query->where('projects_plans.service_provider_fk', '=', $blade["user"]->service_provider_fk );
        $query->where('projects_plans.delete', '=', 0 );
        $query->select('clients.firstname', 'clients.lastname', 'clients.firstname', 'projects_plans.*');
        $plans = $query->get();

        $statusObj = new StateClass();

        foreach($plans as $plan) {
            $response =$statusObj->plans($plan->state);
            $plan->color =  $response['color'];
            $plan->state_txt =  $response['state'];
        }

        $company = App\DatabaseModels\Companies::where("users_fk", "=", $blade["user"]->id)
            ->first();


        if(isset($_GET['sent'])){

            Session::flash('success', 'The plan was sent successfully.');
        }




        return view('backend.freelancer.plans.overview', compact('blade', 'plans', 'company'));

    }
     else {

            return Redirect::to(env("MYHTTP"));
        }
    }

    public function create() {

        if (Auth::check()) {

            $blade["ll"] = App::getLocale();
            $blade["user"] = Auth::user();

            //check if user comes from tour. if yes prevent that he sees the demo dashboard again
            if ($blade["user"]->tour == "true") {
                $blade["user"]->tour = "false";
                $blade["user"]->save();
            }


            $clients = Clients::where("service_provider_fk", "=", $blade["user"]->service_provider_fk)
                ->where("delete", "=", "0")
                ->get();

            //$types = PlansTypes::where("delete", "=", "0")
            //    ->lists("name", "id");

            $types = PlansTypes::lists("name", "id");

            $plan = new Plans();

            if ($blade["user"]->service_provider_fk == 0) {
                $plan->service_provider_fk = -1;
            } else {
                $plan->service_provider_fk = $blade["user"]->service_provider_fk;
            }

            if (isset($_POST['clients'])) {
                $plan->clients_id_fk = $_POST['clients'];
            }

            $plan->hidden = 1;
            $plan->save();

            $company = App\DatabaseModels\Companies::where("users_fk", "=", $blade["user"]->id)
                ->first();

            $countries= Countries::lists('country_name', 'alpha2_code');
            $countries->prepend(Lang::get('freelancer_backend.please_select'), 0);

            return view('backend.freelancer.plans.new', compact('blade', 'clients', 'plan', 'types', 'selected_project', 'projects', 'company', 'countries'));

        }else {

                return Redirect::to(env("MYHTTP"));
            }

    }


    public function edit($id) {

        $blade["ll"] = App::getLocale();
        $blade["user"] = Auth::user();

        $plan = Plans::where("id", "=", $id)
            ->where("delete", "=", "0")
            ->first();

        if($plan->state == 2){

            return Redirect::to($blade["ll"]."/freelancer/plans/")->withInput()->with('error', 'Payment Plan can not be edited.');

        }else{
            $clients = Clients::where("service_provider_fk", "=", $blade["user"]->service_provider_fk)
                ->where("delete", "=", "0")
                ->get();


            $types = PlansTypes::where("delete", "=", "0")
                ->lists("name","id");

            $milestones_edit = PlansMilestone::where("projects_plans_id_fk", "=", $id)
                ->first();

            $countries= Countries::lists('country_name', 'alpha2_code');
            $countries->prepend(Lang::get('freelancer_backend.please_select'), 0);

            return view('backend.freelancer.plans.edit', compact('countries', 'blade', 'clients', 'plan', 'types', 'milestones_edit'));

        }
    }


    public function save(Request $request) {

        $blade["ll"] = App::getLocale();
        $blade["user"] = Auth::user();
        $input = Request::all();

        $plan = Plans::where("id", "=", $input['plan'])
            ->first();

        if(isset($input['clients']))
            $plan->clients_id_fk = $input['clients'];

        if(isset($input['title']))
            $plan->name = $input['title'];

        if(isset($input['reference']))
            $plan->reference = $input['reference'];

        if(isset($input['projects-dropdown']))
            $plan->projects_id_fk = $input['projects-dropdown'];

        if(isset($input['creation-date']) && $input['creation-date']!=""){
            //$creation = date("Y-m-d", strtotime($input['creation-date']) );

            $teile = explode("/", $input['creation-date']);
            $creation =  $teile[2]."-".$teile[1]."-".$teile[0]; // Teil1


            $plan->date = $creation;
        }

        if(isset($input['typ']))
            $plan->typ = $input['typ'];


        if(isset($input['comment']))
            $plan->comment = $input['comment'];

        if($plan->state < 2){
            $plan->state = 0;
        }

        $plan->hidden = 0;
        //$plan->hash = Hash::make(time());
        $plan->hash = time();
        $plan->save();

        PlansMilestone::where("projects_plans_id_fk", "=", $input['plan'])
            ->delete();


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

            if(isset($input['pay-due'])){
                $milestone->due_typ = $input['pay-due'];
            }

            $milestone->typ = $input['typ'];

            if(isset($input['pay-due']) && $input['pay-due'] == 3){
                $milestone->due_at = $input['due-date'];
            }

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
                $milestone->due_at = $input['due_date'][$key];

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

                $milestone->save();
            }
        }



        return response()->json([
            'message'   => 'Successfully saved'

        ]);

    }


    public function delete($id) {

        $blade["ll"] = App::getLocale();
        $blade["user"] = Auth::user();

        $project = Plans::where("id", "=", $id)
            ->first();

        $project->delete = 1;
        $project->save();

        return Redirect::to($blade["ll"]."/freelancer/plans/")->withInput()->with('success', 'Payment plan successfully deleted');

    }


    public function getPlanByTyp(){

        $input = Request::all();

        if(isset($input['typedit'])){

            $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $input['typedit'])
                ->first();

            if(isset($milestones->typ) && $milestones->typ == 1){
                return view('backend.freelancer.plans.payment-single', compact('blade', 'clients', 'plan', 'milestones'));
            }else{
                return view('backend.freelancer.plans.payment-milestones', compact('blade', 'clients', 'plan', 'milestones'));
            }

        }else{

            if(isset($input['typ']) && $input['typ'] == 1){
                return view('backend.freelancer.plans.payment-single', compact('blade', 'clients', 'plan'));
            }else{
                return view('backend.freelancer.plans.payment-milestones', compact('blade', 'clients', 'plan'));
            }

        }

    }


    public function send() {

        $lang = App::getLocale();
        $user = Auth::user();
        $input = Request::all();
        //$plan = $this->save($input);

        $plan = Plans::where("id", "=", $_GET['plan'])
            ->first();

        if($plan->state == 2){

            return response()->json([
                'message'   => 'Your Payment was already sent earlier.'

            ]);

        }else{
            $plan->state =  1;
            $plan->save();

            $client = Clients::where("id", "=", $_GET['clients'])
                ->first();

            $company = App\DatabaseModels\Companies::where("id", "=", $user->service_provider_fk)
                ->first();


            if($_GET['test-mail'] == "true"){
                $to = $user->email;
            } else{
                $to = $client->email;
            }


            //$mango_obj = new MangoClass($this->mangopay);
            //$url=   $mango_obj->createTransaction($company, $client, $input['single-amount']);

            Mail::send('emails.client_paylink', compact('data', 'client', 'company', 'user', 'plan', 'lang'), function ($message) use ($client, $company, $user, $to) {
                $message->from($user->email, $user->firstname." ".$user->lastname);
                $message->to($to);
                $message->subject($company->name." - Payment Plan");
            });


            if(env("APP_ENV") == "live") {
                $subject = "Live Server: Payment Plan";
            }elseif(env("APP_ENV") == "dev") {
                $subject = "Dev Server: Payment Plan";
            }else{
                $subject = "Local Server: Payment Plan";
            }


            Mail::send('emails.client_paylink', compact('data', 'client', 'company', 'user', 'plan', 'lang'), function ($message) use ($subject, $client, $company, $user) {
                $message->from($user->email, $user->firstname." ".$user->lastname);
                $message->subject($subject);
                $message->to('bcc@trustfy.io');
            });

            return response()->json([
                'message'   => 'Your Payment Plan was send to your client'

            ]);
        }

    }


    function getDocs(){

        $docs = PlanDocs::where('plan_id_fk', '=', $_GET['typ'] )
            ->where('delete', '=', '0' )
            ->get();

        return view('backend.freelancer.plans.docs', compact('blade', 'docs'));

    }

    function deleteDoc(){

        $docs = PlanDocs::where('id', '=', $_GET['variable'] )
            ->first();

        $docs->delete = 1;
        $docs->save();

        return $docs;

    }


    function loadPreview($id){


        $blade["locale"] = App::getLocale();

        //get all plan details for the normal payment plan view
        $query = DB::table('projects_plans');
        $query->join('clients', 'projects_plans.clients_id_fk', '=', 'clients.id');
        $query->where('projects_plans.id', '=', $id);
        $query->select('clients.firstname', 'clients.lastname', 'clients.email', 'clients.firstname', 'clients.address1', 'clients.city', 'clients.address2', 'projects_plans.*');
        $plan = $query->first();

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();

        $user = App\DatabaseModels\Users::where("id", "=", $company->users_fk)
            ->first();

        $docs = PlanDocs::where("plan_id_fk", "=", $plan->id)
            ->where('delete', '=', '0' )
            ->get();

        $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
            ->OrderBy('order', 'asc')
            ->get();

        $hash = $plan->hash;

        return view('frontend.clients.payment-plan-preview', compact('blade', 'plan', 'user', 'company', 'milestones', 'docs', 'hash'));


    }



    function loadPlan($hash){


        $blade["ll"] = App::getLocale();

        //get all plan details for the normal payment plan view
        $query = DB::table('projects_plans');
        $query->join('clients', 'projects_plans.clients_id_fk', '=', 'clients.id');
        $query->where('projects_plans.hash', '=', $hash);
        $query->select('clients.firstname', 'clients.lastname', 'clients.email', 'clients.firstname', 'clients.address1', 'clients.city', 'clients.address2', 'projects_plans.*');
        $plan = $query->first();

        if($plan->delete ==1){

            return view('frontend.clients.payment-plan-deleted', compact('blade'));

        }else{

            $company = Companies::where("id", "=", $plan->service_provider_fk)
                ->first();

            $user = App\DatabaseModels\Users::where("id", "=", $company->users_fk)
                ->first();

            $docs = PlanDocs::where("plan_id_fk", "=", $plan->id)
                ->where("delete", "=", "0")
                ->get();

            $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $plan->id)
                ->OrderBy('order', 'asc')
                ->get();

            $hash = $plan->hash;

            foreach ($milestones as $milestone){
                $statusObj = new StateClass();
                $milestone->status = $statusObj->milestones($milestone->paystatus);
            }

            return view('backend.freelancer.plans.show', compact('blade', 'plan', 'user', 'company', 'milestones', 'docs', 'hash', 'status'));
        }
    }

    public function workDone($id) {

        $milestone = PlansMilestone::where("id", "=", $id)
            ->first();

        $milestone->paystatus = 11;
        $milestone->save();

        $plan = Plans::where("id", "=", $milestone->projects_plans_id_fk)
            ->first();

        $company = Companies::where("id", "=", $plan->service_provider_fk)
            ->first();

        $client = Clients::where("id", "=", $plan->clients_id_fk)
            ->first();

        $planUrl = env("APP_URL") . "/" . App::getLocale() . "/payment-plan/".$plan->hash;

        $subject = "Trustfy Payments - Work completed";
        $data['content'] =  "<p>Good news! <br> <br>".$company->name." has marked \"".$milestone->name."\" as complete.</p>";
        $data['content'] .= "<p>Click below to view the payment plan and release your payment. <br> <br></p>";

        $data['content'] .='
            <p>
               <a href="'.$planUrl.'" style="background-color: #19A3B8; text-decoration: none; border-color: #19A3B8; padding: 10px; color:#fff; font-size: 14px; border-radius: .25rem; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out" class="btn btn-primary" target="_blank">Open Plan</a>                  
            </p>
        ';

        $msg_obj = new MessagesClass();
        $msg_obj->sendStandardMail($subject, $data, $client->email, $company->logo, null);


        return response()->json([
            'message'   => 'great'

        ]);

    }

}
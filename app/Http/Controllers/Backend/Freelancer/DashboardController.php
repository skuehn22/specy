<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 21.11.2018
 * Time: 16:42
 */

namespace App\Http\Controllers\Backend\Freelancer;

// Libraries
use App, Auth, Redirect, DB;

use App\Http\Controllers\Controller;
use App\DatabaseModels\PlansMilestone;
use App\DatabaseModels\MessagesCompanies;
use App\DatabaseModels\Clients;
use App\DatabaseModels\Plans;
use App\DatabaseModels\Users;
use App\Classes\StateClass;
use App\Classes\PlansDetailsClass;
use App\Classes\UsersClass;
use App\Classes\MangoClass;

class DashboardController extends Controller
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

            $user = Auth::user();

            if($user->logins_sum <= 1 || $user->logins_sum == null){
                $user = Users::where("id", "=", 118)
                    ->first();

                $user->tour="true";

            }

            if(isset($_GET['tour']) && $_GET['tour']=="activate" ){

                $user = Users::where("id", "=", $user->id)
                    ->first();

                $user->tour = "true";
                $user->save();


            }

            $blade["ll"] = App::getLocale();

            $company = App\DatabaseModels\Companies::where("users_fk", "=", $user->id)
                ->first();


            $setup = $user->setup;


            $plans = Plans::where("service_provider_fk", "=", $user->service_provider_fk)
                ->where("hidden", "=", "0")
                ->where("delete", "=", "0")
                ->get();

            $clients = Clients::where("service_provider_fk", "=", $user->service_provider_fk)
                ->where("delete", "=", "0")
                ->get();


            $plansList= Plans::where("service_provider_fk", "=", $user->service_provider_fk)
                ->where("delete", "=", "0")
                ->where("hidden", "=", "0")
                ->lists('name', 'id');


            $last_plan = Plans::where("service_provider_fk", "=", $user->service_provider_fk)
                ->where("delete", "=", "0")
                ->first();


            $messages = MessagesCompanies::where("company_id_fk", "=", $user->service_provider_fk)
                ->where("delete", "=", "0")
                ->paginate(3);


            $planObj = new PlansDetailsClass();
            $funds = $planObj->getFundsDetails($user->service_provider_fk);

            if($funds['total']>0){
                $percent['funded'] = $funds['funded'] * 100 / $funds['total'];
                $percent['pending'] = $funds['pending'] * 100 / $funds['total'];
                $percent['released'] = $funds['released'] * 100 / $funds['total'];
            }else{
                $percent['funded'] = 0;
                $percent['pending'] = 0;
                $percent['released'] = 0;
            }

            if($percent['funded'] == 0) {
                $openRight['funded'] =  0;
                $openLeft['funded'] =  0;
            }else{
                if( $percent['funded'] >50){
                    $openRight['funded'] =  180;
                    $openLeft['funded'] =  $percent['funded'] *360 / 100;
                }else{
                    $openRight['funded'] = $percent['funded'] *360 / 100;
                    $openLeft['funded'] =  0;
                }
            }

            if($percent['pending'] == 0) {
                $openRight['pending'] =  0;
                $openLeft['pending'] =  0;
            }else{
                if($percent['pending']>50){
                    $openRight['pending'] =  180;
                    $openLeft['pending'] =  $percent['pending'] *360 / 100;
                }else{
                    $openRight['pending'] = $percent['pending'] *360 / 100;
                    $openLeft['pending'] =  0;
                }
            }

            if($percent['released'] == 0) {
                $openRight['released'] =  0;
                $openLeft['released'] =  0;
            }else{
                if($percent['released']>50){
                    $openRight['released'] =  180;
                    $openLeft['released'] =  $percent['released'] *360 / 100;
                }else{
                    $openRight['released'] = $percent['released'] *360 / 100;
                    $openLeft['released'] =  0;
                }
            }

            $upcoming = $planObj->upcomingPayment($user->service_provider_fk);


            $usersObj = new UsersClass();
            $usersObj->checkSystem($company);



            $planUrl = env("APP_URL") . "/" . App::getLocale() . "/payment-plan/release-milestone/abc";
            return view('backend.freelancer.dashboard', compact('planUrl', 'blade', 'user', 'setup', 'openRight', 'company', 'openLeft','last_plan', 'plans', 'plansList', 'messages', 'funds', 'upcoming', 'clients', 'last_plan'));

        } else {

            return Redirect::to(env("MYHTTP"));
        }

    }

    public function loadProject() {

        if (Auth::check()) {

            $blade["ll"] = App::getLocale();
            $blade["user"] = Auth::user();

            if($_GET['id']!="undefined"){

                $query = DB::table('projects_plans');
                $query->join('clients', 'projects_plans.clients_id_fk', '=', 'clients.id');
                $query->where('projects_plans.id', '=', $_GET["id"]);
                $query->where('projects_plans.delete', '=', "0");
                $query->select('projects_plans.*', 'clients.*');
                $project = $query->first();

                //set last viewed to load relevant project when the user returns
                //set past viewed project to 0



                $docs = App\DatabaseModels\PlanDocs::where("plan_id_fk", "=", $_GET["id"])
                    ->where("delete", "=", "0")
                    ->first();

                $statusObj = new StateClass();
                $response =$statusObj->plans($project->state);

                $project->color =  $response['color'];
                $project->state =  $response['state'];

                $milestones = PlansMilestone::where("projects_plans_id_fk", "=", $_GET["id"])
                    ->where("delete", "=", "0")
                    ->OrderBy('order', 'asc')
                    ->get();

                if(!empty($milestones)){


                    foreach ($milestones as $milestone){
                        $statusObj = new StateClass();
                        $status = $statusObj->milestonesClient($milestone->paystatus);
                        $milestone->statusTxt = $status['state'];
                        $milestone->color = $status['color'];
                        $milestone->info = $status['info'];

                    }

                }


            }


            return view('backend.freelancer.dashboard.projects-details', compact('blade', 'setup', 'project', 'docs', 'milestones'));

        } else {

            return Redirect::to(env("MYHTTP"));
        }

    }


    public function loadMsgDetails()
    {


        $msg = MessagesCompanies::where("id", "=", $_GET['msg'])
            ->first();

        $typ = $msg->typ;

        return response()->json(['success' => 'Msg successfully created', 'data' => $msg, 'typ' => $typ]);
    }



    public function loadPlan()
    {

        if (Auth::check()) {

            $blade["ll"] = App::getLocale();
            $blade["user"] = Auth::user();

            $plan = Plans::where("id", "=", $_GET['id'])
                ->first();

            if(isset($plan)){
                $statusObj = new StateClass();
                $response =$statusObj->plans($plan->state);

                $plan->color =  $response['color'];
                $plan->state =  $response['state'];
            }

            return view('backend.freelancer.dashboard.plan-details', compact('blade','plan'));

        }
    }


    public function tourDone()
    {

        if (Auth::check()) {

            $blade["ll"] = App::getLocale();
            $blade["user"] = Auth::user();

            $user = Users::where("id", "=", $blade["user"]->id)
                ->first();

            $user->tour = "false";
            $user->save();

            return $user;

        }
    }




}
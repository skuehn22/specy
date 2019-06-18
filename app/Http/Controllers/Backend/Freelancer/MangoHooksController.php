<?php


namespace App\Http\Controllers\Backend\Freelancer;

// Libraries
use App, Auth;

use App\Http\Controllers\Controller;
use App\DatabaseModels\MangoHooks;
use App\DatabaseModels\MangoPayout;
use App\DatabaseModels\MangoKyc;
use App\DatabaseModels\MessagesCompanies;
use App\DatabaseModels\Users;
use App\DatabaseModels\PlansMilestone;
use App\DatabaseModels\Plans;
use App\Classes\MessagesClass;

class MangoHooksController extends Controller
{

    public function receive()
    {
        $hook = new MangoHooks();
        $hook->type = $_GET['EventType'];
        $hook->ressourceId = $_GET['RessourceId'];
        $hook->save();

        switch ($hook->type) {

            case "KYC_SUCCEEDED":

                $kycdoc = MangoKyc::where("created_id", "=", $hook->ressourceId)
                    ->first();
;
                $user = Users::where("service_provider_fk", "=", $kycdoc->company_id_fk)
                    ->first();

                $subject = "Trustfy Payments - KYC document accepted";
                $data['content'] = $kycdoc->doc_type." accepted";
                $msg_obj = new MessagesClass();
                $msg_obj->sendStandardMail($subject, $data, $user->email, null, null);

                $msg = new MessagesCompanies();
                $msg->typ   = 2;
                $msg->unique_id    =  $hook->ressourceId;
                $msg->meassage    = $data['content'];
                $msg->company_id_fk = $kycdoc->company_id_fk;
                $msg->projects_id_fk = "";
                $msg->save();

                break;

            case "PAYOUT_NORMAL_SUCCEEDED":

                $payout = MangoPayout::where("mango_id", "=", $hook->ressourceId)
                    ->first();

                $payout->status = $hook->type;
                $payout->save();

                $milestone = PlansMilestone::where("id", "=", $payout->milestone_id_fk)
                    ->first();

                $milestone->paystatus = 4;
                $milestone->save();

                //check if that was the last open milestone and the project is finsihed
                $all_milestones = PlansMilestone::where("projects_plans_id_fk", "=", $milestone->projects_plans_id_fk)
                    ->where('paystatus', '<', '4')
                    ->get();


                if(empty($all_milestones)){

                    $plan = Plans::where("id", "=", $milestone->projects_plans_id_fk)
                        ->first();

                    $plan->state = 2;
                    $plan->save();

                }

                break;

            case "PAYOUT_NORMAL_FAILED":

                $payout = MangoPayout::where("mango_id", "=", $hook->ressourceId)
                    ->first();

                $payout->status = $hook->type;
                $payout->save();

                $user = Users::where("service_provider_fk", "=", $payout->company_id_fk)
                    ->first();

                $subject = "Trustfy Payments - Payout failed";
                $data['content'] = "Payout failed - please contact trustfy!";

                $msg_obj = new MessagesClass();
                $msg_obj->sendStandardMail($subject, $data, $user->email, null, null);


                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";

        }


    }

}
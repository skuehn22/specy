<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 27.02.2019
 * Time: 11:00
 */

namespace App\Classes;

use App, Auth, Request, Redirect, Form, DB, MangoPay, Mail, Hash, DateTime;
use App\Http\Controllers\Controller;
use App\DatabaseModels\MessagesCompanies;
use App\DatabaseModels\Companies;
use App\DatabaseModels\ClientsMangowallets;
use App\DatabaseModels\Clients;


class PlansDetailsClass  extends Controller
{

    //global sender function
    public function getFundsDetails($user){

    $query = DB::table('projects_plans_milestones');
    $query->join('projects_plans', 'projects_plans_milestones.projects_plans_id_fk', '=', 'projects_plans.id');
    $query->where('projects_plans.service_provider_fk', '=', $user);
    $query->where('projects_plans_milestones.delete', '=', '0');
    $query->where('projects_plans.delete', '=', '0');
    $query->where('projects_plans_milestones.due_at', '!=', null);
    $query->select('projects_plans_milestones.*');
    $funds = $query->get();

    $fundsCalculation['pending'] = 0;
    $fundsCalculation['funded'] = 0;
    $fundsCalculation['released'] = 0;
    $fundsCalculation['total'] = 0;

    foreach ($funds as $fund){

        switch ($fund->paystatus) {

            case "0":
                $fundsCalculation['pending'] = $fundsCalculation['pending'] + $fund->amount;
                break;

            case "1":
                $fundsCalculation['pending'] = $fundsCalculation['pending'] + $fund->amount;
                break;

            case "2":
                $fundsCalculation['funded'] = $fundsCalculation['funded'] + $fund->amount;
                break;

            case "3":
                $fundsCalculation['pending'] = $fundsCalculation['released'] + $fund->amount;
                break;

            case "4":
                $fundsCalculation['released'] = $fundsCalculation['released'] + $fund->amount;
                break;

            case "8":
                $fundsCalculation['released'] = $fundsCalculation['released'] + $fund->amount;
                break;


            default:
                $fundsCalculation['unknown'] = 0;
        }

        $fundsCalculation['total'] = $fundsCalculation['total'] + $fund->amount;

    }

      return $fundsCalculation;

    }


    public function upcomingPayment($user){

        $today = date('m/d/Y');

        $query = DB::table('projects_plans_milestones');
        $query->join('projects_plans', 'projects_plans_milestones.projects_plans_id_fk', '=', 'projects_plans.id');
        $query->where('projects_plans.service_provider_fk', '=', $user);
        $query->where('projects_plans_milestones.delete', '=', '0');
        $query->where('projects_plans.delete', '=', '0');
        $query->where('projects_plans_milestones.due_at', '!=', null);
        $query->where('projects_plans_milestones.due_at', '>', $today);
        $query->select('projects_plans_milestones.*', 'projects_plans.name AS planName');
        $funds = $query->get();


        $upcoming = "01/01/2080";

        foreach ($funds as $fund){

            if($fund->paystatus <4){
                if( new DateTime($fund->due_at) < new DateTime($upcoming) ){
                    $upcoming = $fund->due_at;
                    $upcoming_fund = $fund;
                }
            }



        }

        if(isset($upcoming_fund)){
            return $upcoming_fund;
        }else{
            return false;
        }



    }


}
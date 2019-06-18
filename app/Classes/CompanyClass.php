<?php
namespace App\Classes;

use App, Auth, DB, Hash;
use MangoPay, Redirect, Request;
use App\Http\Controllers\Controller;
use App\DatabaseModels\CompaniesMangowallets;
use App\DatabaseModels\Companies;
use App\DatabaseModels\CompaniesBank;
use App\DatabaseModels\Clients;
use App\DatabaseModels\MangoKyc;
use App\Classes\MangoClass;
use App\Classes\MessagesClass;

class CompanyClass extends Controller
{



    public function checkMangoRequirements($company) {


        if(!$company->mango_id){
            $status['legal'] = 1;
        }else{
            $status['legal'] = 0;
        }


        $bank = $this->checkMangoBank($company);

        if(empty($bank) || !$bank->mango_bank_id){
            $status['bank'] = 1;
        }else{
            $status['bank'] = 0;
        }

        //$kyc = $this->checkMangoKYC($company);

        //if(!$kyc){
        //    $status['kyc'] = 1;
        //}


            return $status;



    }


    public function checkMangoBank($company) {

        $bank = CompaniesBank::where("service_provider_fk", "=", $company->id)
            ->first();

        return $bank;
    }


    public function checkMangoKYC($company) {

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


    public function sentMailMangoRequirements($company, $client, $milestone) {

        $subject = "Trustfy - Payment released";
        $data['content'] =  "<p>Great news! <br>".$client->firstname." ".$client->lastname." has released a payment for ".$milestone->name."<br></p>";
        $data['content'] .= "<p><strong>Complete the verification</strong> and your money will be on its way!<br> <br></p>";

        $data['content'] .='
            <p>
               <a href="https://www.trustfy.io/login" style="background-color: #19A3B8; text-decoration: none; border-color: #19A3B8; padding: 10px; color:#fff; font-size: 14px; border-radius: .25rem; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out" class="btn btn-primary" target="_blank">Add Account Details</a>                  
            </p>';

        $user = App\DatabaseModels\Users::where("id", "=", $company->users_fk)
            ->first();

        $msg_obj = new MessagesClass();
        $msg_obj->sendStandardMail($subject, $data, $user->email, null, null);


    }





}
<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 31.01.2019
 * Time: 13:13
 */

namespace App\Classes;
use App\DatabaseModels\Users;
use App\Http\Requests\Request;

use App\DatabaseModels\MessagesCompanies;

// Libraries
use App, Auth, Redirect, Hash, MangoPay, Session;

class UsersClass
{

    public function saveUser($data) {


        if(isset($data["email"])){
            $checkUser = Users::where("email", "=", $data["email"])->first();
        }

        if(empty($checkUser)) {

            $users = new Users();
            $users->email = $data["email"];
            $users->password =  bcrypt(  $data["password"]);
            $users->active = "0";
            $users->role = 3;
            $users->remember_token = $data["_token"];
            $users->save();

            $msg = new MessagesCompanies();
            $msg->users_id_fk   = $users->id;
            $msg->typ   = 3;
            $msg->unique_id    = $users->id;
            $msg->meassage    = "Welcome to Trustfy, please make yourself at home! We'd love to hear from you-  if you have any feedback for us or there's anything you're not sure about, just drop us a mail at info@trustfy.io and we'll be happy to help.";
            $msg->save();


            $data['email'] = $users->email;
            $data['password'] = $users->password;


            return $data;


        } else {

            return false;

        }

    }

    public function saveTmpUser($data, $tmpmail) {


        if(isset($data["email"])){
            $checkUser = Users::where("email", "=", $data["email"])->first();
        }

        if(empty($checkUser)) {

            $users = new Users();
            $users->email = $tmpmail;
            $users->password =  bcrypt(  $data["password"]);
            //$users->active = "0";
            $users->tmp_mail = $data["email"];
            $users->role = 3;
            $users->remember_token = $data["_token"];
            $users->save();

            $data['email'] = $users->email;
            $data['password'] = $users->password;


            return $data;


        } else {

            return false;

        }

    }

    public function createCompany($data) {

    }


    public function checkSystem($company) {

        if(isset($company) && $company->id!=191){

            if($company->service_provider_fk){
                if(env("APP_ENV") == "live" && (isset($company) && $company->system != 0)) {

                    Session::flash('error', 'It is not a user from the live system. Please contact the administrator.');

                }elseif(env("APP_ENV") != "live" && (isset($company) &&  $company->system == 0)) {

                    Session::flash('error', 'It is not a user from the dev system. Please contact the administrator.');

                }
            }

        }

    }


}
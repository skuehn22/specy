<?php

namespace App\Http\Controllers;
// Libraries
use App, Auth, Redirect, Session, Mail, Input, Validator, Lang, Route, DateTime;
use App\Http\Requests;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

use App\DatabaseModels\Users;
use App\DatabaseModels\TrackingHeader;
use App\Classes\UsersClass;
use App\Classes\MessagesClass;
use App\DatabaseModels\MessagesCompanies;




class LoginController extends Controller
{
    public function login() {
        // Getting all post data
        $data = Input::all();
        $ll = App::getLocale();

        // Applying validation rules.
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:2',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()){
            // If validation falis redirect back to login.

            $msg_wrong_login = "bla";

            return Redirect::to("$ll/reviews")->withInput()->with('error', 'Konto ist inaktiv!');
        }
        else {

            $msg_wrong_login = "bla";

            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );

            // doing login.
            if (Auth::validate($userdata)) {
                if (Auth::attempt($userdata)) {
                    $user = Auth::user();
                    if($user->active == "1") {

                        if($user->role == 0 || $user->role ==200 || $user->role ==3) {


                            $user->last_login = date("Y-m-d H:i:s");
                            $user->logins_sum = $user->logins_sum+1;
                            $user->save();

                            if($user->setup == 0) {
                                return Redirect::to("$ll/freelancer/dashboard?setup=yes")->with('ll', $ll);
                            }else{
                                return Redirect::to("$ll/freelancer/dashboard")->with('ll', $ll);
                            }
                        }else{
                            return Redirect::to("$ll")->withInput()->with('error', 'Unknown Role');
                        }
                    } else {
                        return Redirect::to("$ll")->withInput()->with('error', 'Konto ist inaktiv!');
                    }

                }
            }
            else {
                 return Redirect::to("$ll")->withInput()->with('error', 'Logindaten fehlerhaft!');
            }
        }
    }

    public function loginCheckout() {
        // Getting all post data
        $data = Input::all();
        $ll = App::getLocale();

        // Applying validation rules.
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:2',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            // If validation falis redirect back to login.
            return Redirect::route('bookingPerson')->withInput()->with('error', 'Logindaten fehlerhaft!');
        }
        else {
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
            // doing login.
            if (Auth::validate($userdata)) {
                if (Auth::attempt($userdata)) {
                    $user = Auth::user();
                    if($user->active == "true") {

                        if($user->type == 0 || $user->type ==200 ) {
                            return Redirect::route('bookingPerson');
                        }
                        if ($user->type == 6 || $user->type == 1 ) {
                            return Redirect::to("$ll/");
                        }

                        if($user->type > 1 && $user->type !=200) {
                            return Redirect::intended("$ll/backend");
                        }


                    } else {
                        return Redirect::route('bookingPerson')->withInput()->with('error', 'Konto ist inaktiv!');
                    }

                }
            }
            else {
                // if any error send back with message.
                if (isset($_POST['step4']) && ($_POST['step4'] == 1)) {
                    return Redirect::route('bookingPerson')->withInput()->with('error', 'Logindaten fehlerhaft!');

                }else{
                    return Redirect::route('bookingPerson')->withInput()->with('error', 'Logindaten fehlerhaft!');
                }



            }
        }
    }

    public function logout() {

        if(!isset($_GET['basket'])){
            $ll = App::getLocale();
            Auth::logout(); // logout user
            return Redirect::to("$ll/"); //redirect back to login
        }else{
            $ll = App::getLocale();
            Auth::logout(); // logout user
            return Redirect::route('bookingPerson');
        }


    }

    public function register() {

        $customerDetailsObj = new CustomerDetails();
        $response = $customerDetailsObj->saveUser();

        if($response == false){
            return Redirect::route('bookingPerson')->withInput()->with('error', 'E-Mail bereits vergeben.');
            //return Redirect::route('bookingPerson')->withInput()->with('error', 'Vielen Dank f�r deine Registrierung!');
        }else{

            // Getting all post data
            $data['password'] = $_POST["pw"];
            $data['email'] = $_POST["mail_register"];
            $ll = App::getLocale();

            // Applying validation rules.
            $rules = array(
                'email' => 'required|email',
                'password' => 'required|min:2',
            );

            $validator = Validator::make($data, $rules);

            if ($validator->fails()){
                // If validation falis redirect back to login.

                return Redirect::to("$ll")->withInput()->with('error', 'Logindaten fehlerhaft!');
            }

            else {



                $userdata = array(
                    'email' => $_POST["mail_register"],
                    'password' => $_POST["pw"]
                );
                // doing login.
                if (Auth::validate($userdata)) {
                    if (Auth::attempt($userdata)) {
                        $user = Auth::user();
                        if($user->active == "true") {

                            if($user->type == 0 || $user->type ==200 ) {
                                $msg_login = Lang::get('frontend.login_controller_msg_login');
                                return Redirect::route('bookingPerson')->withInput()->with('success', $msg_login);;
                            }
                            if ($user->type == 6 || $user->type == 1 ) {
                                return Redirect::to("$ll/");
                            }

                            if($user->type > 1 && $user->type !=200) {
                                return Redirect::intended("$ll/backend");
                            }


                        } else {
                            return Redirect::to("$ll")->withInput()->with('error', 'Konto ist inaktiv!');
                        }

                    }
                }
                else {
                    // if any error send back with message.
                    if (isset($_POST['step4']) && ($_POST['step4'] == 1)) {
                        return Redirect::to("$ll/hotel/person")->withInput()->with('error', 'Logindaten fehlerhaft!');
                    }else{
                        return Redirect::to("$ll")->withInput()->with('error', 'Logindaten fehlerhaft!');
                    }
                }
            }
        }

    }

    public function reset() {

        $token = "";

        return view('auth.passwords.reset', compact('blade', 'token'));

    }

    public function resetMail() {



        $subject= "Trustfy Payments - Reset Password";
        $data['content'] = "<h3>Information to your plan protection</h3>Your Plan Protection: <br>".$_GET["email"]."<br> Passwort:".$_GET["password"];

        $msg_obj = new MessagesClass();
        $msg_obj->sendStandardMail($subject, $data, $_GET["email"], null, null);



        return view('auth.passwords.reset', compact('blade', 'token'));

    }


    public function betaRegister() {

        if(isset($_GET['beta']) && $_GET['beta'] == true ){
            $status = 2202;
        }else{
            $status = 0;
        }

        $ll = App::getLocale();

        return view('auth.register', compact('status', 'll'));

    }



    public function betaRegisterNew() {


        $status = 2202;
        $ll = App::getLocale();

        return view('auth.register', compact('status', 'll'));

    }


    public function betaRegisterSimple() {

        if(isset($_POST['freelancer'])){
            $track = new TrackingHeader();
            $track->val1 = $_POST['freelancer'];
            $track->val2 = $_POST['type'];
            $track->val3 = $_POST['amount'];
            $track->val4 = $_POST['cur'];
            $track->save();
        }



        $status = 2204;
        $ll = App::getLocale();

        return view('auth.register-simple', compact('status', 'll'));

    }


    public function betaRegisterNewFree() {


        $status = 2203;
        $ll = App::getLocale();

        return view('auth.register', compact('status', 'll'));

    }


    public function betaRegisterSave() {

        $ll = App::getLocale();

        $usersObj = new UsersClass();
        $response = $usersObj->saveUser($_POST);

        if($_POST['status']!="2204"){
            if(self::pwCheck($_POST)== false){
                return back()->withInput()->with('error', 'Passwords do not match.');
            }
        }


        if($response == false){
            return back()->withInput()->with('error', 'E-Mail already taken.');

        }else{

            $user = Users::where("email", "=", $_POST['email'])->first();

            $msg = new MessagesCompanies();
            $msg->typ   = 3;
            $msg->users_id_fk = $user->id;
            $msg->save();


            if(isset($_POST['status']) && ($_POST['status'] == 2202) || ($_POST['status'] == 2204)){

                $subject = "Direct Beta Version Register";
                $data['content'] = $_POST['email'];

                $msg_obj = new MessagesClass();
                $msg_obj->sendStandardMail($subject, $data, 'sebastian@trustfy.io', null, null);

                $user = Users::where("email", "=", $_POST['email'])->first();
                $user->active = 1;
                $user->free = 0;
                $user->save();
                self::login();

                $subject = "Welcome to Trustfy";
                $msg_obj = new MessagesClass();
                $msg_obj->welcome($user, $subject);

            }else{

                if(isset($_POST['status']) && ($_POST['status'] == 2203)){

                    $subject = "Free Trial Register";
                    $data['content'] = $_POST['email'];

                    $msg_obj = new MessagesClass();
                    $msg_obj->sendStandardMail($subject, $data, 'sebastian@trustfy.io', null, null);

                    $user = Users::where("email", "=", $_POST['email'])->first();
                    $user->active = 1;
                    $user->free = 1;
                    $user->save();
                    self::login();

                    $subject = "Welcome to Trustfy";
                    $msg_obj = new MessagesClass();
                    $msg_obj->welcome($user, $subject);



                }else{

                    $subject = "Register - Trustfy";
                    $data['content'] = $_POST['email'];

                    $msg_obj = new MessagesClass();
                    $msg_obj->sendStandardMail($subject, $data, 'sebastian@trustfy.io', null, null);

                    return back()->withInput()->with('success', 'Thank you for registering. <br> We will get back to you as soon as possible.');

                }

            }



            return Redirect::to("$ll/freelancer/dashboard?setup=yes")->with('ll', $ll);
        }


    }

    public function pwCheck($data) {
        if($data['password'] != $data['password_confirmation']) {

            return false;

        }else{
            return true;
        }
    }

}
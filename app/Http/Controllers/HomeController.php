<?php

namespace App\Http\Controllers;
// Libraries
use App, Auth, Redirect, Session, Mail;
use App\Http\Requests;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

use App\DatabaseModels\Newsletter;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        if(isset($blade["user"]->role)  && $blade["user"]->role == 0) {

            return Redirect::to($blade["locale"]."/freelancer/dashboard")->withInput()->with('success', 'Your payment plan has been created!');


        }else{
            return view('frontend.masters.master-trustfy-homepage', compact('blade'));
        }

    }

    public function reviews()
    {
        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();
        return view('auth.login', compact('blade'));
    }

    public function login()
    {
        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();
        return view('auth.login', compact('blade'));
    }

    public function marketplace() {
        $blade["locale"] = App::getLocale();
        return view('marketplace.index', compact('blade'));
    }

    public function marketplaceCats() {
        $blade["locale"] = App::getLocale();
        return view('marketplace.category', compact('blade'));
    }

    public function marketplaceDetail() {
        $blade["locale"] = App::getLocale();
        return view('marketplace.detail', compact('blade'));
    }

    public function logout(Request $request){

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        Auth::logout();
        Session::flash('success',"Logout successful");
        return Redirect::to($blade["locale"]."/reviews");

    }

    public function newsletter() {
        $blade["locale"] = App::getLocale();

        $data = new Newsletter();
        $data->email = $_POST['email-newsletter'];
        $data->save();

        Mail::send('emails.contact', compact('data'), function ($message) use ($data) {
            $message->from($data->email, "NL");
            $message->to("review@trustfy.io", "trustfy.io")->
            subject('trustfy.io - Newsletter Subscription');
        });

        return redirect()->back()->with('message', 'Thank you very much for your registration!');
    }

    public function contact() {

        $blade["locale"] = App::getLocale();

        if(isset($_POST['name'])){
            $data['name'] = $_POST['name'];
        }else{
            $data['name'] = "";
        }
        
        $data['mail'] = $_POST['email'];
        $data['desc'] = $_POST['message'];

        Mail::send('emails.contact', compact('data'), function ($message) use ($data) {
            $message->from($_POST['email'], $_POST['name']);
            $message->to("review@trustfy.io", "trustfy.io")->
            subject('trustfy.io - Contact Form');
        });


        return redirect()->back()->with('message', 'Thank you very much for your message!');
    }

    public function privacy() {
        $blade["locale"] = App::getLocale();
        return view('frontend.privacy', compact('blade'));
    }

    public function terms() {
        $blade["locale"] = App::getLocale();
        return view('frontend.terms', compact('blade'));
    }


    public function termsDetail() {
        $blade["locale"] = App::getLocale();
        return view('frontend.terms_detail', compact('blade'));
    }

    public function faq() {
        $blade["locale"] = App::getLocale();
        return view('frontend.faq', compact('blade'));
    }

    public function about() {
        $blade["locale"] = App::getLocale();
        return view('frontend.about', compact('blade'));
    }

    public function escrow() {
        $blade["locale"] = App::getLocale();
        return view('frontend.escrow', compact('blade'));
    }


    public function blog1() {
        $blade["locale"] = App::getLocale();
        return view('frontend.blog_post1', compact('blade'));
    }



}

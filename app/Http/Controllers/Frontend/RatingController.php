<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 12.11.2018
 * Time: 11:53
 */

namespace App\Http\Controllers\Frontend;

use App, Session, Mail, Hash;

use App\Http\Controllers\Controller;
use App\DatabaseModels\ItemRating;
use App\DatabaseModels\Rating;
use App\DatabaseModels\MVPUser;

class RatingController extends Controller
{


    public function create() {

        $blade["locale"] = App::getLocale();

        if(isset($_POST['email'])){
            $email= $_POST['email'];
            $user = new MVPUser();
            $user->mail = $_POST['email'];
            $user->save();
        }




        return view('frontend.rating.create', compact('blade', 'email'));

    }

    public function invite() {

        $blade["locale"] = App::getLocale();
        $session = Session::get('user_session');
        return view('frontend.rating.invite', compact('blade'));

    }

    public function open() {

        $blade["locale"] = App::getLocale();
        $session = $_GET['hash'];
        $rating = Rating::where("session", "=", $session)
            ->first();

        return view('frontend.rating.open', compact('blade', 'rating'));

    }

    public function save() {

        $blade["locale"] = App::getLocale();

        if(isset($_POST['pwd'])){
            $pwd = Hash::make($_POST['pwd']);
        }else{
            $pwd="";
        }

        if(isset($_POST['client-mail'])){

            $rating = new Rating();
            $rating->name = $_POST['name'];
            $rating->description = $_POST['description'];
            $rating->email_freelancer = $_POST['freelancer-mail'];
            $rating->email_client = $_POST['client-mail'];
            $rating->name_client = $_POST['name-client'];
            $rating->project_name = $_POST['project-name'];
            $rating->session = Hash::make(time());
            $rating->pwd = $pwd;
            $rating->save();
            $msg= "Success! A review link has been sent to your client.";

            Mail::send('emails.rating', compact('rating'), function ($message) use ($rating) {
                $message->from('review@trustfy.io', 'trustfy.io');
                $message->bcc('sebastian@work-smarter.io', 'Sebastian');
                $message->to($rating->email_client, $rating->name_client)->
                subject('trustfy.io - Review');
            });

        }

        return view('frontend.rating.add', compact('blade', 'msg', 'rating'));

    }


    public function store() {

        $blade["locale"] = App::getLocale();
        $itemId = "123445";
        $userID = 1234567;

        $rating = Rating::where("session", "=", $_POST['session'])
            ->first();

        if(!empty($_POST['rating']) && !empty($itemId)){


            $user = new ItemRating();
            $user->itemId = $itemId;
            $user->userId = $userID;
            $user->ratingNumber = $_POST['rating'];
            $user->title = $_POST['title'];
            $user->comments = $_POST['comment'];
            $user->session = $_POST['session'];

            $user->save();

            $msg= "Thank you for your review.";

            Mail::send('emails.rating-received', compact('rating', 'user'), function ($message) use ($rating) {
                $message->from('review@trustfy.io', 'trustfy.io');
                $message->bcc('sebastian@work-smarter.io', 'Sebastian');
                $message->to($rating->email_freelancer, $rating->name)->
                subject('trustfy.io - Rating received');
            });

            return view('frontend.rating.closed', compact('blade', 'msg'));
        }
    }

    public function getOverview() {

        $blade["locale"] = App::getLocale();

        return view('frontend.rating.freelancer-overview', compact('blade', 'msg'));

    }

}
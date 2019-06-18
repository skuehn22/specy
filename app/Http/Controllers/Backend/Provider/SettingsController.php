<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 01.08.2018
 * Time: 16:15
 */

namespace App\Http\Controllers\Backend\Provider;


// Libraries
use App, Request, Auth, Redirect, Hash;

use App\Http\Controllers\Controller;
use App\DatabaseModels\Provider;
use App\DatabaseModels\Users;

class SettingsController extends Controller
{

    public function index() {

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        $user = Users::find($blade["user"]->id);
        $provider = $this->getCompany($blade["user"]);
        $team = Users::where("service_provider_fk", "=", $provider->id)
            ->get();

        return view('backend.settings.index', compact('blade', 'provider', 'user', 'team'));

    }

    public function getCompany($user) {

        $blade["user"] = Auth::user();

        $provider = Provider::where("id", "=", $user->service_provider_fk)
            ->first();

        return $provider;

    }



    public function saveCompany() {

        $blade["user"] = Auth::user();
        $blade["locale"] = App::getLocale();

        $input = Request::all();
        $user = Users::find($blade["user"]->id);

        $provider = Provider::find($blade["user"]->service_provider_fk);
        $provider->name = $input["company"];
        $provider->city = $input["city"];
        $provider->address = $input["address"];
        $provider->country = $input["country"];
        $provider->contact_users_fk = $input["contact"];
        $provider->save();

        $team = Users::where("service_provider_fk", "=", "1")
            ->get();

        return view('backend.settings.index', compact('blade', 'provider', 'user', 'team'));

    }

    public function saveAccount() {

        $blade["user"] = Auth::user();
        $input = Request::all();
        $blade["locale"] = App::getLocale();
        $provider = Provider::find($blade["user"]->service_provider_fk);

        $user = Users::find($blade["user"]->id);
        $user->firstname = $input["firstname"];
        $user->lastname = $input["lastname"];
        $user->email = $input["mail"];
        $user->phone = $input["phone"];

        $user->save();


        return view('backend.settings.index', compact('blade', 'user', 'provider'));

    }

    public function newTeamMember() {

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        return view('backend.settings.new-team-member', compact('blade'));

    }

    public function saveTeamMember() {

        $blade["user"] = Auth::user();
        $input = Request::all();
        $blade["locale"] = App::getLocale();
        $provider = Provider::find($blade["user"]->service_provider_fk);

        $password = Hash::make($input["password"]);

        $user = new Users();
        $user->service_provider_fk = $provider->id;
        $user->firstname = $input["firstname"];
        $user->lastname = $input["lastname"];
        $user->email = $input["mail"];
        $user->phone = $input["phone"];
        $user->active = "1";
        $user->role = "0";
        $user->password = $password;

        $user->save();

        return Redirect::to($blade["locale"]."/provider/settings/")->withInput()->with('success', 'Settings saved');

    }

    public function cancel() {

        $button = '<button type="button" class="btn btn-outline-dark load-content" id="new-team-member">New Team Member</button>';

        return $button;
    }





}
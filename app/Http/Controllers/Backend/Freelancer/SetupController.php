<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 21.11.2018
 * Time: 16:42
 */

namespace App\Http\Controllers\Backend\Freelancer;

// Libraries
use App, Auth, Request, Form;

use App\Http\Controllers\Controller;
use App\DatabaseModels\Companies;
use App\DatabaseModels\Clients;
use App\DatabaseModels\Projects;
use App\DatabaseModels\ProjectsAddress;
use App\DatabaseModels\Users;

class SetupController extends Controller
{

    public function index() {

        if (Auth::check()) {

        $blade["ll"] = App::getLocale();
        $blade["user"] = Auth::user();
        return view('backend.freelancer.setup.welcome', compact('blade'));

        } else {

            return Redirect::to(env("MYHTTP"));
        }
    }

    public function company() {

        $blade["ll"] = App::getLocale();
        $blade["user"] = Auth::user();
        $input = Request::all();

        $data = json_decode($input['company']);

        $company = new Companies();

        $company->firstname = $data->firstname;
        $company->lastname = $data->lastname;
        $company->name = $data->company;
        $company->city = $data->address;
        $company->address = $data->city;
        $company->country = $data->country;
        $company->users_fk = $blade["user"]->id;

        //get logo which was temp in user saved
        $user = Users::where('id', '=',  $blade["user"]->id )
            ->first();

        $company->logo = $user->logo;
        $company->save();

        $user->service_provider_fk = $company->id;
        $user->save();

        return response()->json(['prosuccess' => true, 'data' => $company]);

    }

    public function client() {

        $blade["ll"] = App::getLocale();
        $blade["user"] = Auth::user();
        $input = Request::all();

        $data = json_decode($input['clients']);

        $client = new Clients();

        $client->firstname = $data->firstname;
        $client->lastname = $data->lastname;
        $client->phone = $data->phone;
        $client->mobile = $data->mobile;
        $client->email = $data->mail;

        if(isset($data->currency)){
            $client->currency = $data->currency;
            $client->address1 = $data->address1;
            $client->address2 = $data->address2;
            $client->city = $data->city;
            $client->country = $data->country;
        }

        $client->service_provider_fk = $blade["user"]->service_provider_fk;
        $client->save();

        return response()->json(['success' => 'Client successfully created', 'data' => $client]);

    }


    public function project() {

        $blade["ll"] = App::getLocale();
        $blade["user"] = Auth::user();
        $input = Request::all();

        $data = json_decode($input['project']);

        $project = new Projects();

        $project->name = $data->name;
        $project->desc = $data->desc;
        $project->notes = $data->notes;

        if(isset($data->client)){
            $project->client_id_fk = $data->client;
        }

        $project->service_provider_fk = $blade["user"]->service_provider_fk;
        $project->save();

        $projectaddress = new ProjectsAddress();

        $projectaddress->address1 = $data->address1;
        $projectaddress->address2 = $data->address2;
        $projectaddress->city = $data->city;
        $projectaddress->country = $data->country;
        $projectaddress->project_id_fk = $project->id;

        $projectaddress->save();

        return response()->json(['success' => 'Project successfully created', 'data' => $project]);

    }

    public function done() {

        $blade["ll"] = App::getLocale();
        $user = Auth::user();


        $response = Users::where("id", "=", $user->id)
            ->where("delete", "=",  "0")
            ->first();

        $response->setup=1;
        $response->save();

        return response()->json(['success' => 'Project successfully created', 'data' => $response]);

    }



}
<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 14.08.2018
 * Time: 20:42
 */

namespace App\Http\Controllers\Backend\Provider;

// Libraries
use App, Auth;
use App\DatabaseModels\Clients;
use App\DatabaseModels\Users;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{

    public function index() {

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();
        $clients = Clients::where("service_provider_fk", "=", $blade["user"]->service_provider_fk)
            ->get();

        return view('backend.clients.index', compact('blade', 'clients'));

    }

}
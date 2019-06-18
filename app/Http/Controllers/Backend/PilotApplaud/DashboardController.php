<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 08.10.2018
 * Time: 16:42
 */

namespace App\Http\Controllers\Backend\PilotApplaud;

// Libraries
use App, Auth;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index() {

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        if($blade["user"]->role == 0 ) {
            return Redirect::to($blade["locale"]."/provider/dashboard");
        }

        if($blade["user"]->role == 2 ) {
            return view('backend.pilot_applaud.dashboard', compact('blade'));
        }


        if($blade["user"]->role == 3 ) {
            return view('backend.pilot_applaud.dashboard_performer', compact('blade'));
        }



    }

}
<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 08.10.2018
 * Time: 16:42
 */

namespace App\Http\Controllers\Backend\PilotApplaud;

// Libraries
use App, Auth, Hash;

use App\Http\Controllers\Controller;

class OfferController extends Controller
{

    public function index() {


        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        $hash = Hash::make("test");

        return view('backend.pilot_applaud.calculate-offer', compact('blade', 'hash'));

    }


    public function create() {


        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        $hash = Hash::make("test");

        return view('backend.pilot_applaud.create-offer', compact('blade', 'hash'));

    }


}
<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 01.08.2018
 * Time: 16:42
 */

namespace App\Http\Controllers\Backend\Provider;

// Libraries
use App;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index() {


        $blade["locale"] = App::getLocale();

        return view('backend.provider.dashboard', compact('blade'));

    }

}
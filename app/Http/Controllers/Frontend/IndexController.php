<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 26.06.2018
 * Time: 14:08
 */

namespace App\Http\Controllers\Frontend;

// Libraries
use App;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index() {

        $blade["locale"] = App::getLocale();
        $session = Session::get('user_session');
        return view('backend.frontend.masters.master-trustfy-homepage', compact('blade'));

    }

}
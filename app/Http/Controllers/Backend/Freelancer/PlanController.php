<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 21.11.2018
 * Time: 16:42
 */

namespace App\Http\Controllers\Backend\Freelancer;

// Libraries
use App, Auth;

use App\Http\Controllers\Controller;

class PlanController extends Controller
{

    public function create() {

        if (Auth::check()) {

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        return view('backend.freelancer.plan', compact('blade'));

        } else {

            return Redirect::to(env("MYHTTP"));
        }
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 05.03.2019
 * Time: 13:40
 */

namespace App\Http\Controllers\Backend\Admin;

// Libraries
use App, Auth, Request, Redirect, Form, DB;

use App\Http\Controllers\Controller;
use App\DatabaseModels\Users;


class UsersController extends Controller
{

    public function index() {

        $blade["ll"] = App::getLocale();
        return view('frontend.intern.user-delete', compact('blade'));
    }


    public function delete() {

        $blade["ll"] = App::getLocale();
        $blade["user"] = Auth::user();

        Users::where("email", "=", $_POST['delete-mail']) ->delete();

        return Redirect::to($blade["ll"]."/admin/users")->withInput()->with('success', 'User deleted!');

    }

}
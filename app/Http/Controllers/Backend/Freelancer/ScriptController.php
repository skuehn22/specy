<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 23.01.2019
 * Time: 16:34
 */

namespace App\Http\Controllers\Backend\Freelancer;


class ScriptController extends Controller
{

    public function index(){
        return response()->view('custom-script')->header('Content-Type','application/javascript');
    }

}
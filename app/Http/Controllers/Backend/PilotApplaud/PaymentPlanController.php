<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 11.10.2018
 * Time: 11:03
 */

namespace App\Http\Controllers\Backend\PilotApplaud;


class PaymentPlanController
{

    public function createPaymentPlan(){

        $blade["locale"] = App::getLocale();
        $blade["user"] = Auth::user();

        return view('backend.pilot_applaud.create-payment-plan', compact('blade', 'hash'));

    }

}
<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 11.10.2018
 * Time: 09:32
 */


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    /* Provider Dashboard */
    Route::any('/applaud/admin/dashboard', 'Backend\PilotApplaud\DashboardController@index') ;
    Route::any('/samples/onlinetradesmen/create-offer', 'Backend\Samples\OnlineTradesmenController@createOffer') ;
    Route::any('/applaud/admin/set-escrow', 'Backend\PilotApplaud\EscrowController@createTransaction') ;
    Route::any('/applaud/admin/set-escrow', 'Backend\PilotApplaud\EscrowController@createTransaction') ;
    Route::any('/applaud/secure/escrow/{hash}', 'Backend\PilotApplaud\EscrowController@openTransaction') ;
    Route::any('/applaud/secure/escrow/client/checkout/{hash}', 'Backend\PilotApplaud\EscrowController@clientCheckout') ;
    Route::any('/onlinetradesmen', 'Backend\Samples\OnlineTradesmenController@index') ;
    Route::any('/samples/onlinetradesmen/builder-dashboard', 'Backend\Samples\OnlineTradesmenController@builderDashboard') ;

});
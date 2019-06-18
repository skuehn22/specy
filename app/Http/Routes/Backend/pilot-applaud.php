<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 08.10.2018
 * Time: 11:44
 */


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::any('/applaud/admin/dashboard', 'Backend\PilotApplaud\DashboardController@index') ;
    Route::any('/applaud/performer/calculate-offer', 'Backend\PilotApplaud\OfferController@index') ;
    Route::any('/applaud/performer/create-offer', 'Backend\PilotApplaud\OfferController@create') ;
    Route::any('/applaud/admin/calculate-offer', 'Backend\PilotApplaud\OfferController@index') ;
    Route::any('/applaud/admin/set-escrow', 'Backend\PilotApplaud\EscrowController@createTransaction') ;
    Route::any('/applaud/secure/escrow/{hash}', 'Backend\PilotApplaud\EscrowController@openTransaction') ;
    Route::any('/applaud/payed/escrow/', 'Backend\PilotApplaud\EscrowController@f') ;
    //Route::any('/applaud/secure/escrow/client/checkout/{hash}', 'Backend\PilotApplaud\EscrowController@clientCheckout') ;
    //Route::any('/applaud/secure/escrow/confirm/{transaction}', 'Backend\PilotApplaud\EscrowController@confirmTransaction') ;
    Route::any('/applaud/performer/dashboard', 'Backend\PilotApplaud\DashboardController@index') ;

});

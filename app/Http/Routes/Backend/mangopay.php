<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 01.08.2018
 * Time: 11:44
 */

Route::group(['prefix' => LaravelLocalization::setLocale()], function() {

    Route::any('/mangopay/test', 'Backend\Mangopay\TestController@index');
    Route::any('/mangopay/sandbox', 'Backend\Mangopay\SandboxController@index');
    Route::any('/mangopay/sandbox/create-user', 'Backend\Mangopay\SandboxController@createUser');
    Route::any('/mangopay/sandbox/create-legal-user', 'Backend\Mangopay\SandboxController@createLegalUser');
    Route::any('/mangopay/sandbox/create-wallet', 'Backend\Mangopay\SandboxController@createWallet');
    Route::any('/mangopay/sandbox/get-wallets-in', 'Backend\Mangopay\SandboxController@getWalletsIn');
    Route::any('/mangopay/sandbox/get-wallets-out', 'Backend\Mangopay\SandboxController@getWalletsOut');
    Route::any('/mangopay/sandbox/create-payin', 'Backend\Mangopay\SandboxController@createPayIn');
    Route::any('/mangopay/sandbox/create-payout', 'Backend\Mangopay\SandboxController@createPayOut');

    Route::any('/mangopay/payline-template', 'Backend\Mangopay\TestController@template');

});
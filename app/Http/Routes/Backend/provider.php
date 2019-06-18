<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 01.08.2018
 * Time: 11:44
 */


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

    /* Provider Dashboard */
    Route::any('/provider/dashboard', 'Backend\Provider\DashboardController@index') ;

    /* Provider Contracts */
    Route::any('/provider/contract-types', 'Backend\Provider\ContractsController@getTypes') ;
    Route::any('/provider/create-proposal/', 'Backend\Provider\ContractsController@createProposal') ;
    Route::any('/provider/create-proposal-blank/', 'Backend\Provider\ContractsController@createProposalBlank') ;
    Route::any('/provider/save-proposal-blank/', 'Backend\Provider\ContractsController@saveProposalBlank') ;
    Route::any('/provider/load-proposal-blank-template/', 'Backend\Provider\ContractsController@loadProposalTemplate') ;

    /* Provider Clients */
    Route::any('/provider/clients', 'Backend\Provider\ClientsController@index') ;


    /* Provider Settings */
    Route::any('/provider/settings', 'Backend\Provider\SettingsController@index') ;
    Route::any('/provider/settings/save-company', 'Backend\Provider\SettingsController@saveCompany') ;
    Route::any('/provider/settings/save-account', 'Backend\Provider\SettingsController@saveAccount') ;
    Route::any('/provider/settings/new-team-member', 'Backend\Provider\SettingsController@newTeamMember') ;
    Route::any('/provider/settings/save-team-member', 'Backend\Provider\SettingsController@saveTeamMember') ;
    Route::any('/provider/settings/cancel', 'Backend\Provider\SettingsController@cancel') ;

});
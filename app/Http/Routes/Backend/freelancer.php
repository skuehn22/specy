<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 26.06.2018
 * Time: 14:12
 */



Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

    Route::get('/freelancer/demo/install', 'Backend\Freelancer\DemoController@index');

    Route::get('/ajax_upload', 'AjaxUploadController@index');
    Route::post('/ajax_upload/action', 'AjaxUploadController@action')->name('ajaxupload.action');
    Route::any('/ajax_upload/delete', 'AjaxUploadController@delete')->name('ajaxupload.delete');

    Route::get('/ajax_file_upload', 'AjaxUploadController@indexFile');
    Route::any('/ajax_file_upload/action', 'AjaxUploadController@contractUpload')->name('ajax_file_upload.action');

    Route::any('/freelancer/dashboard', 'Backend\Freelancer\DashboardController@index');
    Route::any('/freelancer/dashboard/load-project', 'Backend\Freelancer\DashboardController@loadProject');
    Route::any('/freelancer/dashboard/load-plan', 'Backend\Freelancer\DashboardController@loadPlan');
    Route::any('/freelancer/msg/get/details', 'Backend\Freelancer\DashboardController@loadMsgDetails');
    Route::any('/freelancer/plan/create', 'Backend\Freelancer\PlanController@create');

    Route::any('/freelancer/setup/welcome', 'Backend\Freelancer\SetupController@index');
    Route::any('/freelancer/setup/save/save-company', 'Backend\Freelancer\SetupController@company');
    Route::any('/freelancer/setup/save/save-client', 'Backend\Freelancer\SetupController@client');
    Route::any('/freelancer/setup/save/save-project', 'Backend\Freelancer\SetupController@project');
    Route::any('/freelancer/setup/save/done', 'Backend\Freelancer\SetupController@done');

    Route::any('/freelancer/clients', 'Backend\Freelancer\ClientManagementController@index');
    Route::any('/freelancer/clients/new', 'Backend\Freelancer\ClientManagementController@create');
    Route::any('/freelancer/clients/edit/{id}', 'Backend\Freelancer\ClientManagementController@edit');
    Route::any('/freelancer/clients/save/{id}', 'Backend\Freelancer\ClientManagementController@save');
    Route::any('/freelancer/clients/delete/{id}', 'Backend\Freelancer\ClientManagementController@delete');
    Route::any('/freelancer/clients/get-by-id', 'Backend\Freelancer\ClientManagementController@getDropdownById');
    Route::any('/freelancer/clients/get-by-id-client', 'Backend\Freelancer\ClientManagementController@getById');

    Route::any('/freelancer/projects', 'Backend\Freelancer\ProjectManagementController@index');
    Route::any('/freelancer/projects/new', 'Backend\Freelancer\ProjectManagementController@create');
    Route::any('/freelancer/projects/edit/{id}', 'Backend\Freelancer\ProjectManagementController@edit');
    Route::any('/freelancer/projects/save/{id}', 'Backend\Freelancer\ProjectManagementController@save');
    Route::any('/freelancer/projects/delete/{id}', 'Backend\Freelancer\ProjectManagementController@delete');
    Route::any('/freelancer/projects/by-client', 'Backend\Freelancer\ProjectManagementController@getByClients');
    Route::any('/freelancer/projects/get-by-id', 'Backend\Freelancer\ProjectManagementController@getById');

    Route::any('/freelancer/plans', 'Backend\Freelancer\PlansManagementController@index');
    Route::any('/freelancer/plans/new', 'Backend\Freelancer\PlansManagementController@create');
    Route::any('/freelancer/plans/edit/{id}', 'Backend\Freelancer\PlansManagementController@edit');
    Route::any('/freelancer/plans/save', 'Backend\Freelancer\PlansManagementController@save')->name('freelancer.plans.save');
    Route::any('/freelancer/plans/finishing/{id}', 'Backend\Freelancer\PlansManagementController@finishing');
    Route::any('/freelancer/plans/sclose/{id}', 'Backend\Freelancer\PlansManagementController@saveAndClose');
    Route::any('/freelancer/plans/delete/{id}', 'Backend\Freelancer\PlansManagementController@delete');
    Route::any('/freelancer/plans/send', 'Backend\Freelancer\PlansManagementController@send')->name('freelancer.plan.send');
    Route::any('/freelancer/plans/get-plan-typ', 'Backend\Freelancer\PlansManagementController@getPlanByTyp');
    Route::any('/freelancer/plans/docs', 'Backend\Freelancer\PlansManagementController@getDocs');
    Route::any('/freelancer/plans/delete-doc', 'Backend\Freelancer\PlansManagementController@deleteDoc');
    Route::any('/freelancer/plans/preview/{id}', 'Backend\Freelancer\PlansManagementController@loadPreview');
    Route::any('/freelancer/plans/payment-plan/{hash}', 'Backend\Freelancer\PlansManagementController@loadPlan');
    Route::any('/freelancer/plans/work-done/{id}', 'Backend\Freelancer\PlansManagementController@workDone');


    Route::any('/freelancer/settings', 'Backend\Freelancer\SettingsController@index') ;
    Route::any('/freelancer/settings/save-company', 'Backend\Freelancer\SettingsController@saveCompany') ;
    Route::any('/freelancer/settings/save-legal', 'Backend\Freelancer\SettingsController@saveLegalUser') ;
    Route::any('/freelancer/settings/save-additional-kyc', 'Backend\Freelancer\SettingsController@saveAdditionalKycData') ;
    Route::any('/freelancer/settings/save-account', 'Backend\Freelancer\SettingsController@saveAccount') ;
    Route::any('/freelancer/settings/new-team-member', 'Backend\Freelancer\SettingsController@newTeamMember') ;
    Route::any('/freelancer/settings/save-team-member', 'Backend\Freelancer\SettingsController@saveTeamMember') ;
    Route::any('/freelancer/settings/cancel', 'Backend\Freelancer\SettingsController@cancel') ;
    Route::any('/freelancer/settings/reset', 'Backend\Freelancer\SettingsController@reset') ;
    Route::any('/freelancer/settings/change-password', 'Backend\Freelancer\SettingsController@resetPw') ;
    Route::any('/freelancer/settings/save-bank', 'Backend\Freelancer\SettingsController@saveBank') ;
    Route::any('/freelancer/settings/kyc-check', 'Backend\Freelancer\SettingsController@kycCheck') ;
    Route::any('/freelancer/settings/email-pref', 'Backend\Freelancer\SettingsController@saveMailPref') ;

    Route::any('/freelancer/unsubscribe/{id}', 'Backend\Freelancer\SettingsController@unsubscribe') ;


    Route::any('/payment-plan/{hash}', 'Frontend\PaymentPlanController@index') ;


    Route::any('/payment-plan/load-preview/{id}', 'Frontend\PaymentPlanController@loadPreview') ;
    Route::any('/payment-plan/preview/{hash}', 'Frontend\PaymentPlanController@preview') ;
    Route::any('/payment-plan/pay-by-card/{hash}', 'Frontend\PaymentPlanController@payCC') ;
    Route::any('/payment-plan/pay-by-bank/{hash}', 'Frontend\PaymentPlanController@payBank') ;
    Route::any('/payment-plan/release-milestone/{id}', 'Frontend\PaymentPlanController@releaseMilestone') ;
    Route::any('/payment-plan/bank-transfer/{hash}', 'Frontend\PaymentPlanController@loadBank');
    Route::any('/payment-plan/bank-completed/{hash}', 'Frontend\PaymentPlanController@completedBank') ;
    Route::any('/payment-plan/bank-reminder/{hash}', 'Frontend\PaymentPlanController@remindBank') ;
    Route::any('/payment-plan/change-methode/{hash}', 'Frontend\PaymentPlanController@changeMethode') ;


    Route::any('/protect-plan', 'Frontend\PaymentPlanController@setProtection') ;
    Route::any('/login-plan', 'Frontend\PaymentPlanController@loginPlan') ;

    Route::any('/mango-hooks', 'Backend\Freelancer\MangoHooksController@receive') ;


    Route::any('/freelancer/tour/done', 'Backend\Freelancer\DashboardController@tourDone') ;



});



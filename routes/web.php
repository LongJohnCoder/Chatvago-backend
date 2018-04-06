<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@show');


/***
 * Authentication Routes
 */
Route::group([
    'middleware' => ['web','auth']
],function () {

    /** Admin Dashboard */
    Route::get('/home', [
        'uses'      =>  'HomeController@show',
        'as'        =>  'admin.dashboard'
    ]);


    /**
     * Not Available for super users
     */
    Route::group(['middleware' => 'notsuperadmin'],function (){

        /**Settings View */
        Route::get('/settings', [
            'uses'  =>  'Settings\DashboardController@show',
            'as'    =>  'settings'
        ]);

    });

    /***
     * Configuration Routes
     */
    Route::group(['prefix' => 'config'], function () {
        /**
         * Configure subscriptions
         */
        Route::resource('subscriptions','Admin\Configuration\SubscriptionController', [
            'names' => [
                'index'     =>  'subscriptions.index',
                'create'    =>  'subscriptions.create',
                'store'     =>  'subscriptions.store',
                'edit'      =>  'subscriptions.edit',
                'update'    =>  'subscriptions.update',
                'destroy'   =>  'subscriptions.delete'
            ]
        ]);
        /**
         * Configure subscription plan intervals
         */
        Route::resource('intervals','Admin\Configuration\PlanIntervalController', [
            'names' => [
                'index'     =>  'intervals.index',
                'create'    =>  'intervals.create',
                'store'     =>  'intervals.store',
                'edit'      =>  'intervals.edit',
                'update'    =>  'intervals.update',
                'destroy'   =>  'intervals.delete'
            ]
        ]);
        /**
         * Active bots
         */
        Route::get('active_Bots',[
            'uses'  => 'Admin\Configuration\BotsController@activeBotIndex',
            'as'    => 'bots.active.list'
        ]);
    });
});
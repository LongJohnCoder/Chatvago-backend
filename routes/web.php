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

        /**Login back as superadmin*/
        Route::get('admin/return', [
            'uses'  =>  'Admin\Configuration\AdminUserController@change_user_superadmin',
            'as'    =>  'admin.switch_to_admin'
        ]);

    });

    /***
     * Configuration Routes
     */
    Route::group(['prefix' => 'config','middleware' => 'superadmin'], function () {
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
         * Configure admin users
         */
        Route::resource('admin','Admin\Configuration\AdminUserController', [
            'names' => [
                'index'     =>  'admin.index',
                'create'    =>  'admin.create',
                'store'     =>  'admin.store',
                'edit'      =>  'admin.edit',
                'update'    =>  'admin.update',
                'destroy'   =>  'admin.delete'
            ]
        ]);

        /**
         * Login as Admin user
         */
        Route::get('admin/change_user/{admin}',[
            'uses'      =>  'Admin\Configuration\AdminUserController@change_user_admin',
            'as'        =>  'admin.change_user'
        ]);

        /**
         * List of users under an admin
         */
        Route::get('admin/users/{admin}',[
            'uses'      =>  'Admin\Configuration\AdminUserController@get_users',
            'as'        =>  'admin.users'
        ]);

    });


    /**
     * Configure end users
     */
    Route::resource('endusers','Admin\Configuration\EndUserController', [
        'names' => [
            'index'     =>  'enduser.index',
            'create'    =>  'enduser.create',
            'store'     =>  'enduser.store',
            'edit'      =>  'enduser.edit',
            'update'    =>  'enduser.update',
            'destroy'   =>  'enduser.delete'
        ]
    ]);

    /**
     * Facebook login routes
     */
    Route::get('/redirect', [
        'uses'  =>  'Admin\SocialAuthFacebookController@redirect',
        'as'    =>  'facebook.redirect'
    ]);

    Route::get('/callback', [
        'uses'  =>  'Admin\SocialAuthFacebookController@callback',
        'as'    =>  'facebook.callback'
    ]);
});
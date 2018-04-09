<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Requests\Configuration\EndUserRequest; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Mail;
use Auth;

class EndUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $auth_user = Auth::user();
            $end_users = (!is_null($auth_user) && $auth_user->role == '1') ? User::endUsers()->get() : $auth_user->end_users()->get() ;
            return view('admin.Pages.Configuration.Users.index',compact('end_users'));

        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $model_not_found) {

            return view('errors.error',[
                'code' => $model_not_found->getCode(),
                'message' => $model_not_found->getMessage()
            ]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            $auth_user = Auth::user();
            $super_admin_flag = (!is_null($auth_user) && $auth_user->role == '1') ? true : false;
            $super_admin_users = (isset($super_admin_flag) && $super_admin_flag) ? User::admin()->pluck('name','id') : [];
            return view('admin.Pages.Configuration.Users.create', compact('super_admin_flag','super_admin_users'));

        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $model_not_found) {

            return view('errors.error',[
                'code' => $model_not_found->getCode(),
                'message' => $model_not_found->getMessage()
            ]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Configuration\EndUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EndUserRequest $request)
    {
        try {

            $check_total_end_users =$this->check_user_count();
            if($check_total_end_users) {

                $user               = new User();
                $user->name         = $request->name;
                $user->email        = $request->email;
                $user->admin_id     = (isset($request->super_admin_flag) && $request->super_admin_flag) ? $request->admin_users : Auth::id();
                $user->role         = '3';
                $user->login_token  = str_random(64);
                $user->save();

                return redirect()->route('enduser.index')->with([
                    'success' => true,
                    'message' => 'You have created an end user.'
                ]);

            } else {

                return redirect()->route('enduser.index')->with([
                    'success' => false,
                    'message' => 'You have reached your limit of user creation.'
                ]);


            }

        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $model_not_found) {

            return view('errors.error',[
                'code' => $model_not_found->getCode(),
                'message' => $model_not_found->getMessage()
            ]);

        }

    }

    /**
     * Checks the total end users present under an admin.
     * @return bool
     */
    protected function check_user_count()
    {
        $check = Auth::user()->stripe_subscriptions;
        $total_users_under_admin = Auth::user()->count_end_users();
        $check_plan = (!is_null($check) && count($check) > 0) ? $check->stripe_subscription_plan : [];
        if(count($check_plan) > 0 && $total_users_under_admin > $check_plan->profile_creation) {
            return false;
        }
        return true;

/*
        Mail::send('admin.Pages.Configuration.Users.enduserCreate',['email' => $request->email,'password' => $user->password,'name'=>$request->name],
            function($message) use($request) {
                $message->from('work@tier5.us','ChatVago');
                $message->to($request->email)->subject('End user created');
            });*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        try{

            $end_users = User::findOrFail($id);
            return view('admin.Pages.Configuration.Users.edit',compact('end_users'));

        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $model_not_found) {

            return view('errors.error',[
                'code' => $model_not_found->getCode(),
                'message' => $model_not_found->getMessage()
            ]);

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Configuration\EndUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EndUserRequest $request, $id)
    {
        try {

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->admin_id = Auth::id();
            $user->role = '3';
            $user->update();

            return redirect()->route('enduser.index')->with([
                'success' => true,
                'message' => 'You have successfully updated the end user details.'
            ]);

        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $model_not_found) {

            return view('errors.error',[
                'code' => $model_not_found->getCode(),
                'message' => $model_not_found->getMessage()
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        try {

            $end_users  = User::findOrFail($request->enduser_id);
            $end_users->delete();

            return response()->json([
                'success'       => true,
                'message'       => 'Successfully deleted the admin.'
            ],200);


        } catch (Exception $exception) {

            return response()->json([
                'success'       => false,
                'code'          => $exception->getCode(),
                'message'       => $exception->getMessage()
            ],($exception->getCode() != 0) ? $exception->getCode() : 500);

        } catch (ModelNotFoundException $modelNotFound) {

            return response()->json([
                'success'       => false,
                'code'          => $modelNotFound->getCode(),
                'message'       => $modelNotFound->getMessage()
            ],($modelNotFound->getCode() != 0) ? $modelNotFound->getCode() : 500);
        }

    }

}

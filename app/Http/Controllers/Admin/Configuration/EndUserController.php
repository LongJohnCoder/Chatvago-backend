<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Requests\Configuration\EndUserRequest; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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

            $end_users = User::endUsers()->get();
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
        return view('admin.Pages.Configuration.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Request\Configuration\EndUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EndUserRequest $request)
    {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->admin_id = Auth::id();
            $user->role = '3';
            $user->save();

            Mail::send('admin.Pages.Configuration.Users.enduserCreate',['email' => $request->email,'password' => $user->password,'name'=>$request->name],
            function($message) use($request) {
            $message->from('work@tier5.us','ChatVago');
            $message->to($request->email)->subject('End user created');
          });

          dd("Check your email wait 30 minutes before requesting again ");
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

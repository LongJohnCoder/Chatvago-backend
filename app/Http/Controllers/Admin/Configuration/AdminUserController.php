<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Requests\Configuration\AdminUserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Auth;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $admins = User::admin()->get();
            return view('admin.Pages.Configuration.Admin_Users.index',compact('admins'));

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

            $admin = User::admin()->findOrFail($id);
            return view('admin.Pages.Configuration.Admin_Users.edit',compact('admin'));

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
    public function update(AdminUserRequest $request, $id)
    {
        try{

            $this->validate($request,[
                'name'  => 'required',
                'email' =>  'required|email|unique:users,email,'.$id
            ]);

            $admin            = User::admin()->findOrFail($id);
            $admin->name      = $request->name;
            $admin->email     = $request->email;
            $admin->update();

            return redirect()->route('admin.index')->with([
                'success' => true,
                'message' => 'You have successfully updated admin details.'
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

            $admin  = User::findOrFail($request->admin_id);
            $admin->delete();

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

    /**
     * Login as admin user
     * @param User $admin
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function change_user_admin(User $admin){
        try {

            Session::put('orig_user', Auth::id());
            Auth::login( $admin );
            return redirect()->back();

        }  catch (Exception $exception) {

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
     * Login as super admin user
     * @param User $admin
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function change_user_superadmin(){
        try {

            $id = Session::pull('orig_user');
            $orig_user = User::find($id);
            Auth::login($orig_user);
            return redirect()->back();

        }  catch (Exception $exception) {

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
     * Get endusers belonging to an admin
     * @param User $admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_users(User $admin) {
        try{
            
            $end_users = (!is_null($admin->end_users)) ? $admin->end_users : [];
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
}

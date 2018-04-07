<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


     public function show_admin()
    {
        return view('admin.Pages.Configuration.Subscriptions.admin_form');
    }
  
}

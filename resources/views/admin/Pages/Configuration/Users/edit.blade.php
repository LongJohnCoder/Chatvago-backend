@extends('layouts.master')

@section('css')
    <link href="{{asset('css/switch.css')}}" rel="stylesheet">
@endsection

@section('module')
    CONFIGURATION
@endsection

@section('title')
    End Users
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Edit End Users</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('enduser.update',$end_users->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('PUT')
                        @include('admin.Pages.Configuration.Users._form',['edit' => 1,'end_users' => $end_users])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection




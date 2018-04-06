@extends('layouts.master')

@section('css')
    <link href="{{asset('css/switch.css')}}" rel="stylesheet">
@endsection

@section('module')
    CONFIGURATION
@endsection

@section('title')
    Configure New Subscription Plan
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Configure New Subscription</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('subscriptions.store')}}" method="post">
                        {{ csrf_field() }}
                        @include('admin.Pages.Configuration.Subscriptions._form',['edit' => 0])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


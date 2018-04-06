@extends('layouts.master')

@section('css')
    <link href="{{asset('css/switch.css')}}" rel="stylesheet">
@endsection

@section('module')
    CONFIGURATION
@endsection

@section('title')
    Edit Subscription Plan
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Configure New Bot</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('subscriptions.update',$subscription_plan->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('PUT')
                        @include('admin.Pages.Configuration.Subscriptions._form',['edit' => 1,'subscription_plan' => $subscription_plan])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



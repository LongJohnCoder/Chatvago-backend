@extends('layouts.master')

@section('css')
    <link href="{{asset('css/switch.css')}}" rel="stylesheet">
@endsection

@section('module')
    CONFIGURATION
@endsection

@section('title')
    Users
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Create New End User</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('enduser.store')}}" method="post">
                        {{ csrf_field() }}
                        @include('admin.Pages.Configuration.Users._form',['edit' => 0])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('#interval').change(function(){
            var interval =  $(this).val();
            switch (interval) {
                case 'day':
                    list(365);
                    break;
                case 'week':
                    list(52);
                    break;
                case 'month':
                    list(12);
                    break;
                case 'year':
                    list(1);
                    break;
                default: //default child option is blank
                    $("#interval_count").html(`<option value="">----Select----</option>`);
                    break;
            }
        });

        function list(count) {
            $("#interval_count").html(`<option value="">----Select----</option>`);
            for(let i = 1; i <= count; i++ ) {
                $("#interval_count").append(`<option value=`+i+`>`+i+`</option>`);
            }
        }
    </script>
@endsection

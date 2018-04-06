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
                    <form action="{{route('intervals.update',$interval->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('PUT')
                        @include('admin.Pages.Configuration.Plan_Intervals._form',['edit' => 1,'interval' => $interval])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            var interval        =   '{{$interval->interval}}';
            var interval_count  =   '{{$interval->interval_count}}';
            switch (interval) {
                case 'day':
                    list(365,interval_count);
                    break;
                case 'week':
                    list(52,interval_count);
                    break;
                case 'month':
                    list(12,interval_count);
                    break;
                case 'year':
                    list(1,interval_count);
                    break;
                default: //default child option is blank
                    $("#interval_count").html(`<option value="">----Select----</option>`);
                    break;
            }
        });

        $('#interval').change(function(){
            var interval =  $(this).val();
            switch (interval) {
                case 'day':
                    list(365,'');
                    break;
                case 'week':
                    list(52,'');
                    break;
                case 'month':
                    list(12,'');
                    break;
                case 'year':
                    list(1,'');
                    break;
                default: //default child option is blank
                    $("#interval_count").html(`<option value="">----Select----</option>`);
                    break;
            }
        });

        function list(count,interval_count) {
            $("#interval_count").html(`<option value="">----Select----</option>`);
            for(let i = 1; i <= count; i++ ) {
                if(i == interval_count) {
                    console.log(interval_count);
                    $("#interval_count").append(`<option value=`+i+` selected>`+i+`</option>`);
                } else {
                    $("#interval_count").append(`<option value=`+i+`>`+i+`</option>`);
                }
            }
        }
    </script>
@endsection


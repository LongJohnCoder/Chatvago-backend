@extends('layouts.master')

@section('css')
    <link href="{{asset('css/switch.css')}}" rel="stylesheet">
@endsection

@section('module')
    CONFIGURATION
@endsection

@section('title')
    Configure New Bot
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Configure New Bot</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('bots.store')}}" method="post">
                        {{ csrf_field() }}
                        @include('admin.pages.Configuration.Bots._form',['edit' => 0])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{asset('js/lib/bootstrap-toggle/toggle.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#status').bootstrapSwitch('state','1');
        });

        $('#status').bootstrapSwitch({
            size: 'small',
            onText: 'Enable',
            offText: 'Disable',
            onColor: 'success',
            offColor: 'danger',
            onSwitchChange: function(event, state) {
                $('#status').val(state ? '1' : '0').change();
            }
        });
    </script>
@endsection

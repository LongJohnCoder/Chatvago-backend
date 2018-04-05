@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('css/lib/sweetalert/sweetalert.css')}}">
@endsection

@section('module')
    CONFIGURATION
@endsection

@section('title')
    Bots
@endsection


@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Bot Details</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>BOT ID</th>
                            <th>BROADCAST TOKEN</th>
                            <th>Status</th>
                            <th colspan="2"><div class="text-center">Actions</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($bots))
                            @forelse($bots as $bot)
                            <tr>
                                <td>
                                    {{$bot->id}}
                                </td>
                                <td>{{$bot->bot_id}}</td>
                                <td>{{$bot->broadcast_token}}</td>
                                <td>
                                    @if($bot->status == '1')
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td><a class="btn btn-danger delete" data-id="{{$bot->id}}">Delete</a></td>
                                <td><a class="btn btn-info" href="{{route('bots.edit',$bot->id)}}">Edit</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6"><div class="text-center">There are no results available.</div></td>
                            </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="6"><div class="text-center">There are no results available.</div></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/lib/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $('.delete').click(function () {
            var bot_id = $(this).data('id')
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this particular configuration ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-error",
                    confirmButtonText: "Yes!",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url: "bots/"+bot_id,
                        type: 'post',
                        data: {_method: 'delete', 'bot_id': bot_id, _token : '{{csrf_token()}}'},
                        success:function(response){
                            if(response.success) {
                                swal({
                                    title: "Success",
                                    text: response.message,
                                    type: "success",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Ok"
                                },function () {
                                    location.reload();
                                });
                            } else {
                                swal(response.message,'Please try again after sometime' , "error");
                            }
                        },
                        error: function (error) {
                            swal(error.statusText, "Please try again after sometime", "error");
                        }
                    })
                });
        });
    </script>
@endsection
@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('css/lib/sweetalert/sweetalert.css')}}">
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
        <div class="card">
            <div class="card-title">
                <h4>End User List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="text-center">#</div></th>
                            <th><div class="text-center">NAME</div></th>
                            <th><div class="text-center">EMAIL</div></th>
                            <th><div class="text-center">Actions</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($end_users))   
                          @forelse($end_users as $end_user)
                                <tr>
                                    <td>
                                        <div class="text-center">
                                            <div class="round-img">
                                                <img src="{!! (!is_null($end_user->photo_url) && !empty($end_user->photo_url)) ? $end_user->photo_url : asset('img/avatar/common.png') !!}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{$end_user->name}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{$end_user->email}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a class="btn btn-danger delete" data-id="{{$end_user->id}}" title="Delete User"><i class="fa fa-trash-o"></i></a>
                                            <a class="btn btn-info" href="{{route('enduser.edit',$end_user->id)}}" title="Edit User"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-info" href="#" title="Available Facebook Pages"><i class="fa fa-file-o"></i></a>
                                            <a class="btn btn-facebook" href="{{route('facebook.redirect')}}" title="Facebook Login"><i class="fa fa-facebook"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"><div class="text-center">There are no results available.</div></td>
                                </tr>
                            @endforelse
                        @else 
                            <tr>
                                <td colspan="4"><div class="text-center">There are no results available.</div></td>
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
            var enduser_id =   $(this).data('id');
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this particular end user?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-error",
                    confirmButtonText: "Yes!",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url: "endusers/"+enduser_id,
                        type: 'post',
                        data: {
                            _method: 'delete',
                            'enduser_id': enduser_id,
                            _token : '{{csrf_token()}}'
                        },
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
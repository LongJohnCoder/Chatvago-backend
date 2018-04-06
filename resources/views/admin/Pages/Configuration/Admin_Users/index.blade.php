@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('css/lib/sweetalert/sweetalert.css')}}">
@endsection

@section('module')
    CONFIGURATION
@endsection

@section('title')
    Admin List
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Admin Details</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><div class="text-center">#</div></th>
                                <th><div class="text-center">NAME</div></th>
                                <th><div class="text-center">EMAIL</div></th>
                                <th><div class="text-center">PHONE</div></th>
                                <th><div class="text-center">STRIPE ID</div></th>
                                <th><div class="text-center">CURRENT BILLING PLAN</div></th>
                                <th><div class="text-center">BILLING ADDRESS</div></th>
                                <th><div class="text-center">TRIAL ENDING DATE</div></th>
                                <th><div class="text-center">REGISTERED</div></th>
                                <th><div class="text-center">Actions</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($admins))
                                @forelse($admins as $admin)
                                    <tr>
                                        <td>
                                            <div class="round-img">
                                                <img src="{!! (!is_null($admin->photo_url) && !empty($admin->photo_url)) ? $admin->photo_url : asset('img/avatar/common.png') !!}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                {{$admin->name}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                {{$admin->email}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                {!! (!is_null($admin->phone) || !empty($admin->phone)) ? $admin->phone : 'N/A' !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                {!! (!is_null($admin->stripe_id) || !empty($admin->stripe_id)) ? $admin->stripe_id : 'N/A' !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                {!! (!is_null($admin->current_billing_plan) || !empty($admin->current_billing_plan)) ? $admin->current_billing_plan : 'N/A' !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                {!! (!is_null($admin->billing_address) || !empty($admin->billing_address)) ? $admin->billing_address : 'N/A' !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                {!! (!is_null($admin->trial_ends_at) || !empty($admin->trial_ends_at)) ? $admin->trial_ends_at->toFormattedDateString() : 'N/A' !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                {!! (!is_null($admin->created_at) || !empty($admin->created_at)) ? $admin->created_at->toFormattedDateString() : 'N/A' !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-danger delete" data-id="{{$admin->id}}" title="Delete Admin User"><i class="fa fa-trash-o"></i></a>
                                                <a class="btn btn-info" href="{{route('admin.edit',$admin->id)}}" title="Edit Admin User"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-success" href="{{route('admin.change_user',['admin' => $admin->id])}}" title="Login As Admin"><i class="fa fa-sign-in"></i></a>
                                                <a class="btn btn-primary" href="{{route('admin.users',['admin' => $admin->id])}}" title="Users"><i class="fa fa-users"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10"><div class="text-center">There are no results available.</div></td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="10"><div class="text-center">There are no results available.</div></td>
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
            var admin_id =   $(this).data('id');
            swal({
                        title: "Are you sure?",
                        text: "You want to delete this particular admin?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-error",
                        confirmButtonText: "Yes!",
                        closeOnConfirm: false
                    },
                    function(){
                        $.ajax({
                            url: "admin/"+admin_id,
                            type: 'post',
                            data: {
                                _method: 'delete',
                                'admin_id': admin_id,
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
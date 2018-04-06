@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('css/lib/sweetalert/sweetalert.css')}}">
@endsection

@section('module')
    CONFIGURATION
@endsection

@section('title')
    Subscription Plan Intervals
@endsection


@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Plan Interval Details</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="text-center">#</div></th>
                            <th><div class="text-center">NAME</div></th>
                            <th><div class="text-center">Actions</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($plan_intervals))
                            @forelse($plan_intervals as $plan_interval)
                            <tr>
                                <td>
                                    <div class="text-center">
                                        {{$plan_interval->id}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        {{$plan_interval->name}}
                                    </div>
                                </td>
                                @if($plan_interval->is_editable == '1')
                                    <td>
                                        <div class="text-center">
                                            <a class="btn btn-danger delete" data-id="{{$plan_interval->id}}" title="Delete Interval"><i class="fa fa-trash-o"></i></a>
                                            <a class="btn btn-info" href="{{route('intervals.edit',$plan_interval->id)}}" title="Edit Interval"><i class="fa fa-pencil"></i></a>
                                        </div>
                                    </td>
                                @else
                                    <td colspan="2"></td>
                                @endif
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
            var interval_id =   $(this).data('id');
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this particular subscription interval?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-error",
                    confirmButtonText: "Yes!",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url: "intervals/"+interval_id,
                        type: 'post',
                        data: {
                            _method: 'delete',
                            'interval_id': interval_id,
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
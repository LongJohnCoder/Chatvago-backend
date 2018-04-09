<div class="form-body">
    <h3 class="card-title m-t-15">Details : </h3>
    <hr>
    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('name')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label">Name <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-3">
                <input type="text" name="name" id="name" class="input-rounded form-control" placeholder="Name" required  value="{{isset($admin) ? $admin->name : old('name') }}">
                <small class="form-control-feedback"> Admin Name. </small>
            </div>
            @if((isset($errors) && $errors->has('name')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('name')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('email')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label">Email <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-3">
                <input type="email" name="email" id="email" class="input-rounded form-control" placeholder="Email" required  value="{{isset($admin) ? $admin->email : old('email') }}">
                <small class="form-control-feedback"> Admin Name. </small>
            </div>
            @if((isset($errors) && $errors->has('email')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('email')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <div class="form-group">
        <input type="hidden" value="{{$edit}}" name="edit">
    </div>


</div>
<div class="form-actions">
    <input type="hidden" value="{{base64_encode($admin->id)}}" name="admin_id">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>{{(isset($edit) && $edit == '1') ? 'Update': 'Save'}} </button>
    <a class="btn btn-inverse" href="{{route('intervals.index')}}">Cancel</a>
</div>
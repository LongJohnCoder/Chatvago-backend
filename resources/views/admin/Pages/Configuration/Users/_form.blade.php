<div class="form-body">
    <h3 class="card-title m-t-15">Details : </h3>
    <hr>
    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('name')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-3">
                <label class="control-label">Full Name  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-5">
                <input type="text" name="name" id="name" class="input-rounded form-control" placeholder="Full-Name" value="{{isset($end_users) ? $end_users->name : old('name') }}" required>
                <small class="form-control-feedback"> User Full Name as in Facebook. </small>
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
            <div class="col-md-3">
                <label class="control-label">Email Id  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-5">
                <input type="email" name="email" id="email" class="input-rounded form-control" placeholder="Email" value="{{isset($end_users) ? $end_users->email : old('email') }}" required>
                <small class="form-control-feedback"> User Email Id. </small>
            </div>
            @if((isset($errors) && $errors->has('email')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('email')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    @if(isset($super_admin_flag) && $super_admin_flag)
    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('admin_users')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-3">
                <label class="control-label">Admin user:  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-5">
                <select class="input-rounded form-control" name="admin_users" required>
                    <option value="">----Select----</option>
                    @isset($super_admin_users)
                        @foreach($super_admin_users as $key => $super_admin_user)
                        <option value="{{$key}}">{{$super_admin_user}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            @if((isset($errors) && $errors->has('admin_users')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('admin_users')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->
    @endif

</div>
<div class="form-actions">
    <input type="hidden" value="{{(isset($super_admin_flag) && $super_admin_flag) ? '1' : '0'}}" name="super_admin_flag">
    <input type="hidden" value="{{(isset($end_users)) ? base64_encode($end_users->id) : '0'}}" name="end_user_id">
    <input type="hidden" value="{{(isset($edit)) ? $edit : '0'}}" name="edit">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>{{(isset($edit) && $edit == '1') ? 'Update': 'Create'}} </button>
    <button type="button" class="btn btn-inverse">Cancel</button>
</div>
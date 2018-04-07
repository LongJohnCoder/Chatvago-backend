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
                <input type="text" name="name" id="name" class="input-rounded form-control" placeholder="Enter Full name" value="{{isset($end_users) ? $end_users->name : old('name') }}">
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
                <input type="email" name="email" id="email" class="input-rounded form-control" placeholder="Enter Email Id" value="{{isset($end_users) ? $end_users->email : old('email') }}">
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

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('password')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-3">
                <label class="control-label">Password  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-5">
                <input type="password" name="password" id="password" class="input-rounded form-control" placeholder="Enter strong Password">
                <small class="form-control-feedback"> User Password. </small>
            </div>
            @if((isset($errors) && $errors->has('password')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('password')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('confirm_password')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-3">
                <label class="control-label">Confirm Password  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-5">
                <input type="password" name="confirm_password" id="confirm_password" class="input-rounded form-control" placeholder="Enter strong Password">
                <small class="form-control-feedback"> Confirm Password will be the same as Password. </small>
            </div>
            @if((isset($errors) && $errors->has('confirm_password')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('confirm_password')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>{{(isset($edit) && $edit == '1') ? 'Update': 'Create'}} </button>
    <button type="button" class="btn btn-inverse">Cancel</button>
</div>
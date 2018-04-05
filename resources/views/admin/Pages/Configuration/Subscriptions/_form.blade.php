<div class="form-body">
    <h3 class="card-title m-t-15">Details : </h3>
    <hr>
    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('plan_name')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label">Plan Name  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-6">
                <input type="text" name="plan_name" id="plan_name" class="input-rounded form-control" placeholder="Plan-Name" value="{{isset($bot) ? $bot->bot_id : old('bot_id') }}">
                <small class="form-control-feedback"> Your Stripe Plan Name. </small>
            </div>
            @if((isset($errors) && $errors->has('plan_name')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('plan_name')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('plan_id')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label">Plan ID  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-6">
                <input type="text" name="plan_id" id="plan_id" class="input-rounded form-control" placeholder="Plan-ID" value="{{isset($bot) ? $bot->bot_id : old('bot_id') }}">
                <small class="form-control-feedback"> Your Stripe Plan ID. </small>
            </div>
            <div class="col-md-1">
                <span title="You must input your stripe plan id">
                    <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                </span>
            </div>
            @if((isset($errors) && $errors->has('plan_id')))
                <div class="col-md-3 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('plan_id')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('plan_price')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label"> Your Stripe Plan Price  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-6">
                <input type="text" name="plan_price" id="plan_price" class="input-rounded form-control" placeholder="Plan-Price" value="{{isset($bot) ? $bot->bot_id : old('bot_id') }}">
                <small class="form-control-feedback"> Plan Price in dollars ($). </small>
            </div>
            @if((isset($errors) && $errors->has('plan_price')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('plan_price')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('plan_interval')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label"> Your Stripe Plan Interval <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-6">
                <select name="plan_interval" class="input-rounded form-control">
                    <option value="">-----Select-----</option>
                    <option value="1">1</option>
                </select>
                <small class="form-control-feedback"> Stripe Plan Interval. </small>
            </div>
            @if((isset($errors) && $errors->has('plan_interval')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('plan_interval')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->


    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('profile_creation')) ? 'has-error' : ''}}">
        <div class="row">
            <div class="col-md-2">
                <label class="control-label">Maximum User Profiles  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-6">
                <input type="text" name="profile_creation" id="profile_creation" class="input-rounded form-control" value="{{isset($bot) ? $bot->broadcast_token : old('broadcast_token') }}">
                <small class="form-control-feedback"> Maximum number of user profiles that can be created with the plan. </small>
            </div>
            @if((isset($errors) && $errors->has('profile_creation')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('profile_creation')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('pages_per_user')) ? 'has-error' : ''}}">
        <div class="row">
            <div class="col-md-2">
                <label class="control-label">Pages Per User  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-6">
                <input type="text" name="pages_per_user" id="pages_per_user" class="input-rounded form-control" value="{{isset($bot) ? $bot->broadcast_token : old('broadcast_token') }}">
                <small class="form-control-feedback"> Maximum number of pages a user can be associated with the plan. </small>
            </div>
            @if((isset($errors) && $errors->has('pages_per_user')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('pages_per_user')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('avail_broadcast')) ? 'has-error' : ''}}">
        <div class="row">
            <div class="col-md-2">
                <label class="control-label">Avail Broadcast  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-6">
                <input type="checkbox" name="avail_broadcast" id="avail_broadcast" value="{{isset($bot) ? $bot->broadcast_token : old('broadcast_token') }}">
                <small class="form-control-feedback"> Whether to avail broadcast messaging feature for the users. </small>
            </div>
            @if((isset($errors) && $errors->has('avail_broadcast')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('avail_broadcast')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->


</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>{{(isset($edit) && $edit == '1') ? 'Update': 'Save'}} </button>
    <button type="button" class="btn btn-inverse">Cancel</button>
</div>
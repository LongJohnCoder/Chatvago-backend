<div class="form-body">
    <h3 class="card-title m-t-15">Details : </h3>
    <hr>
    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('bot_id')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label">Bot ID  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-6">
                <input type="text" name="bot_id" id="bot_id" class="input-rounded form-control" placeholder="Bot-ID" value="{{isset($bot) ? $bot->bot_id : old('bot_id') }}">
                <small class="form-control-feedback"> Chatfuel Bot ID. </small>
            </div>
            @if((isset($errors) && $errors->has('bot_id')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('bot_id')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->
    <!-- form-group -->
    <div class="form-group {{isset($errors) && $errors->has('broadcast_token') ? 'has-error' : ''}}">
        <div class="row">
            <div class="col-md-2">
                <label class="control-label">Broadcast Token  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-6">
                <input type="text" name="broadcast_token" id="broadcast_token" class="input-rounded form-control" placeholder="Broadcast Token" value="{{isset($bot) ? $bot->broadcast_token : old('broadcast_token') }}">
                <small class="form-control-feedback"> Broadcast API Token For Chatfuel. </small>
            </div>
            @if((isset($errors) && $errors->has('broadcast_token')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('broadcast_token')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label class="control-label">Status : </label>
            </div>
            <div class="col-md-5">
                <input type="checkbox" name="status" id="status" value="{{isset($bot) ? $bot->status : old('status') }}">
            </div>
        </div>
    </div>
    <input type="hidden" name="edit" value="{{isset($edit) ? $edit : '0' }}">
    <!-- form-group -->
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>{{(isset($edit) && $edit == '1') ? 'Update': 'Save'}} </button>
    <button type="button" class="btn btn-inverse">Cancel</button>
</div>
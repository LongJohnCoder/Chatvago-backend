<div class="form-body">
    <h3 class="card-title m-t-15">Details : </h3>
    <hr>
    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('interval_name')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label">Interval Name <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-3">
                <input type="text" name="interval_name" id="interval_name" class="input-rounded form-control" placeholder="Interval-Name"  value="{{isset($interval) ? $interval->name : old('interval_name') }}">
                <small class="form-control-feedback"> Custom Interval Name. </small>
            </div>
            @if((isset($errors) && $errors->has('interval_name')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('interval_name')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('interval')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label">Interval <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-3">
                <select name="interval" id="interval" class="input-rounded form-control" >
                    <option value="">----Select----</option>
                    @foreach($plan_intervals as $key => $plan_interval)
                     <option value="{{$key}}" data-interval="{{$key}}" @if(isset($interval) && $interval->interval == $key){{'selected'}}@endif>{{$plan_interval}}</option>
                    @endforeach
                </select>
            </div>
            @if((isset($errors) && $errors->has('interval')))
                <div class="col-md-4 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('interval')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <!-- form-group -->
    <div class="form-group {{(isset($errors) && $errors->has('interval_count')) ? 'has-error' : ''}}">
        <div class="row p-t-20">
            <div class="col-md-2">
                <label class="control-label">Interval Count  <span class="text-danger">*</span> : </label>
            </div>
            <div class="col-md-3">
                <select name="interval_count" id="interval_count" class="input-rounded form-control" >
                    <option value="">----Select----</option>
                </select>
            </div>
            @if((isset($errors) && $errors->has('interval_count')))
                <div class="col-md-3 text-danger">
                    <span><i class="fa fa-times-circle"></i>{{$errors->first('interval_count')}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- form-group -->

    <div class="form-group">
        <input type="hidden" value="{{$edit}}" name="edit">
        <small>The number of intervals between subscription billings. For example, Interval=Monthly and Interval Count=3 bills every 3 months. Maximum of one year interval allowed (1 year, 12 months, or 52 weeks).</small>
    </div>


</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>{{(isset($edit) && $edit == '1') ? 'Update': 'Save'}} </button>
    <a class="btn btn-inverse" href="{{route('intervals.index')}}">Cancel</a>
</div>
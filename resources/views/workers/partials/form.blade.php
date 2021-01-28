<div class="box-body">
    {!! Form::bsText('name',old('name'),['autofocus']) !!}
    {!! Form::bsText('email',old('email')) !!}
    {!! Form::bsText('phone',old('phone')) !!}
    <div class="col-md-6 col-sm-12 form-group">
        <div class="col-md-2 col-sm-12">
            <label for="password" class="control-label">Password</label>
        </div>
        <div class="col-md-10 col-sm-12">
            <input type="password" class="form-control" name="password" id="password">
        </div>
    </div>
    <div class="col-md-6 col-sm-12 form-group">
        <div class="col-md-2 col-sm-12">
            <label for="confirm_password" class="control-label">Confirm Password</label>
        </div>
        <div class="col-md-10 col-sm-12">
            <input type="password" class="form-control" name="confirm_password" id="confirm_password">
        </div>
    </div>
</div>


<div class="box-body">
    <div class="col-md-12 col-sm-12 form-group @error('name') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {{ Form::label('name', 'Name:', ['class'=>'control-label required'])}}
        </div>
        <div class="col-md-10 col-sm-12">
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autofocus')) !!}
        </div>

    </div>
    <div class="col-md-12 col-sm-12 form-group @error('email') has-error @enderror">
        {{ Form::label('email', 'Email:', ['class'=>'col-sm-2 control-label required'])}}
        <div class="col-md-10 col-sm-12">
            {!! Form::email('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-md-12 col-sm-12 form-group @error('status') has-error @enderror">
        {{ Form::label('status', 'Status:', ['class'=>'col-sm-2 control-label'])}}
        <div class="col-sm-10">
            {!! Form::hidden('status', 0) !!}
            <input name="status" value="1" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive">
        </div>
    </div>
    @if (Auth::user()->isSuper())
        <div class="col-md-12 col-sm-12 form-group @error('super') has-error @enderror">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox icheck">
                    <label>
                        {{ Form::checkbox('super', '1') }} Is Super Admin
                    </label>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12 col-sm-12 form-group @error('role_id') has-error @enderror">
        {{ Form::label('role', 'Role:', ['class'=>'col-sm-2 control-label required'])}}
        <div class="col-sm-10">
            {!! Form::select('role_id', $roles, null ,array('placeholder' => 'Select Role','class' => 'form-control select2','style'=>'width:100%;')) !!}
        </div>
    </div>
</div>


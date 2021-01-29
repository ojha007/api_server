<div class="box-body">
    <div class="col-md-12 col-sm-12 form-group @error('name') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('name','Name:') !!}
        </div>
        <div class="col-md-9 col-sm-12">
            {!! Form::text('name',null,['class'=>'form-control','autofocus']) !!}
        </div>
    </div>
    <div class="col-md-12 col-sm-12 form-group @error('name') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('email','Email:') !!}
        </div>
        <div class="col-md-9 col-sm-12">
            {!! Form::email('email',null,['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-12 col-sm-12 form-group @error('phone') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('phone','Phone:') !!}
        </div>
        <div class="col-md-9 col-sm-12">
            {!! Form::number('phone',null,['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-12 col-sm-12 form-group @error('password') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('password','Password:') !!}
        </div>
        <div class="col-md-9 col-sm-12">
            {!! Form::password('password',['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-12 col-sm-12 form-group @error('password_confirmation') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('password_confirmation','Confirm Password:') !!}
        </div>
        <div class="col-md-9 col-sm-12">
            {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-12 col-sm-12 form-group @error('status') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('status','Status:') !!}
        </div>
        <div class="col-md-8">
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="1" checked="checked">
                    Active
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="0" id="manual">
                    InActive
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 form-group @error('avatar') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('avatar','Avatar:') !!}
        </div>
        <div class="col-md-9 col-sm-12">
            <input type="file" name="avatar" id="avatar">
        </div>
    </div>
</div>


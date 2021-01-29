<div class="box-body">
    {!! Form::bsText('title') !!}
    <div class="col-md-12 col-sm-12 form-group @error('date') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('date','Task Date:') !!}
        </div>
        <div class="col-md-9 col-sm-12">
            <input type="datetime-local"
                   name="date"
                   id="date"
                   class="form-control">
        </div>
    </div>
    {!! Form::bsText('address') !!}
    <div class="form-group col-md-12 @error('worker_id') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('user_id','Select Workers:') !!}
        </div>
        <div class="col-md-9 col-sm-12">
            {!! Form::select('user_id',$selectWorkers ?? '',null,
             ['class'=>'form-control','placeholder'=>'Select Worker']) !!}
        </div>
    </div>
    <div class="form-group col-md-12 @error('state_id') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('state_id','Select States:') !!}
        </div>
        <div class="col-md-9 col-sm-12">
            {!! Form::select('state_id',$selectStates ?? '',null,
             ['class'=>'form-control','placeholder'=>'Select State']) !!}
        </div>

    </div>
    {!! Form::bsTextArea('description') !!}
</div>

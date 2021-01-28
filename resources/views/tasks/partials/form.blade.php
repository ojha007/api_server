<div class="box-body">
    {!! Form::bsText('title') !!}
    <div class="form-group col-md-6  @error('date') has-error @enderror">
        <label for="date"> Task Date :</label>
        <input type="datetime-local"
               name="date"
               id="date"
               class="form-control">
    </div>
    {!! Form::bsText('address') !!}
    <div class="form-group col-md-6 @error('worker_id') has-error @enderror">
        <label for="worker"> Assign Worker:</label>
        {!! Form::select('worker_id',$selectWorkers ?? '',null,
            ['class'=>'form-control','placeholder'=>'Assign Worker']) !!}
    </div>
    <div class="form-group col-md-6 @error('state_id') has-error @enderror">
        <label for="date">Select States:</label>
        {!! Form::select('state_id',$selectStates ?? [],[],['class'=>'form-control select2','placeholder'=>'Select State']) !!}
    </div>
    <div class="col-md-12"></div>
    {!! Form::bsTextArea('description') !!}
</div>

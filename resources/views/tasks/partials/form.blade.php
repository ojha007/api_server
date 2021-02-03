<div class="box-body">

    <div class="form-group col-md-12 @error('worker_id') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('user_id','Select Bookings:') !!}
        </div>
        <div class="col-md-10 col-sm-12">
            {!! Form::select('booking_id',$bookings ?? [],null,
             ['class'=>'form-control','placeholder'=>'Select Booking']) !!}
        </div>
    </div>
    {!! Form::bsText('title') !!}
    <div class="col-md-12 col-sm-12 form-group @error('date') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('date','Task Date:') !!}
        </div>
        <div class="col-md-10 col-sm-12">
            <input type="datetime-local"
                   name="date"
                   id="date"
                   class="form-control">
        </div>
    </div>
    {!! Form::bsText('address',old('address')) !!}
    <div class="form-group col-md-12 @error('worker_id') has-error @enderror">
        <div class="col-md-2 col-sm-12">
            {!! Form::label('user_id','Select Workers:') !!}
        </div>
        <div class="col-md-10 col-sm-12">
            {!! Form::select('user_id',$selectWorkers ?? '',null,
             ['class'=>'form-control','placeholder'=>'Select Worker']) !!}
        </div>
    </div>
    {!! Form::bsTextArea('description') !!}

</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.5.11/full-all/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            if ($("#description").length > 0) {
                CKEDITOR.replace('description');
            }
        })
    </script>
@endpush


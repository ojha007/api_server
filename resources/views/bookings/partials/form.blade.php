@php $user=['1'=>1] @endphp
<div class="box-body">
    {!! Form::bsText('name',old('name'),['p'=>6]) !!}
    {!! Form::bsEmail('email',old('email'),['p'=>6]) !!}
    {!! Form::bsText('phone',old('phone'),['p'=>6]) !!}
    <div class="form-group col-md-6 col-sm-12">
        <div class="col-md-3 col-sm-12">
            <label for="moving_date">Moving Date :</label>
        </div>
        <div class="col-md-9 col-sm-12 @error('moving_date') has-error @enderror">
            {!! Form::text('moving_date',null,['class'=>'form-control datepicker','placeholder'=>'Select Moving Date']) !!}
        </div>
    </div>
    {!! Form::bsText('moving_from_suburb',old('moving_from_suburb'),['p'=>6]) !!}
    {!! Form::bsText('moving_to_suburb',old('moving_to_suburb'),['p'=>6]) !!}
    <div class="form-group col-md-6 col-sm-12">
        <div class="col-md-3 col-sm-12">
            <label for="pickup_address">PickUp Address:</label>
        </div>
        <div class="col-md-9 col-sm-12 @error('pickup_address') has-error @enderror">
            {!! Form::text('pickup_address',null,['class'=>'form-control ',
            'placeholder'=>'Enter a pickup address','autocomplete'=>'on',"runat"=>"server",'id'=>'pickup_address']) !!}
        </div>
        {{Form::hidden('pickup_latitude',null,['id'=>'pickup_latitude'])}}
        {{Form::hidden('pickup_longitude',null,['id'=>'pickup_longitude'])}}

    </div>

    <div class="form-group col-md-6 col-sm-12 p-sm-0">
        <div class="col-md-3 col-sm-12">
            <label for="size_of_moving">Size of moving</label>
        </div>
        <div class="col-md-9 col-sm-12 @error('size_of_moving') has-error @enderror">
            {!! Form::select('size_of_moving',\App\Models\Booking::allSizeOfMoving(),null,
            ['class'=>'form-control','placeholder'=>'Select Moving Size']) !!}
        </div>
    </div>
    <div class="form-group col-md-6 col-sm-12 p-sm-0">
        <div class="col-md-3 col-sm-12">
            <label for="additional_service">Additional Service</label>
        </div>
        <div class="col-md-9 col-sm-12 @error('additional_service') has-error @enderror">
            @foreach(\App\Models\Booking::allAdditionalServices() as $checkbox)
                <label style="margin: 1rem">
                    <input type="checkbox" name="additional_service[]" value="{{$checkbox}}">
                    {{$checkbox}}
                </label>
            @endforeach
        </div>
    </div>
    <div class="form-group col-md-6 col-sm-12">
        <div class="col-md-3 col-sm-12">
            <label for="dropoff_address">Dropoff Address:</label>
        </div>
        <div class="col-md-9 col-sm-12 @error('dropoff_address') has-error @enderror">
            {!! Form::text('dropoff_address',null,['class'=>'form-control ',
            'placeholder'=>'Enter a dropoff address','autocomplete'=>'on',
            "runat"=>"server",'id'=>'dropoff_address']) !!}
        </div>
        {{Form::hidden('dropoff_latitude',null,['id'=>'dropoff_latitude'])}}
        {{Form::hidden('dropoff_longitude',null,['id'=>'dropoff_longitude'])}}
    </div>
    {!! Form::bsText('additional_address',old('additional_address'),['p'=>6]) !!}
    {!! Form::bsText('access_parking',old('access_parking'),['p'=>6]) !!}

    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-1 col-sm-12">
            <label for="inventory">Inventory:</label>
        </div>
        <div class="col-md-11 col-sm-12 p-md-6rem">
            {{Form::textarea('inventory',null,['class'=>'form-control','rows'=>'4'])}}

        </div>
    </div>
    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-1 col-sm-12">
            <label for="comments">Comments:</label>
        </div>
        <div class="col-md-11 col-sm-12 p-md-6rem ">
            {{Form::textarea('comments',null,['class'=>'form-control','rows'=>'4'])}}

        </div>
    </div>
    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-1 col-sm-12">
            <label for="description">Description:</label>
        </div>

        <div class="col-md-11 col-sm-12 p-md-6rem">
            <textarea class="form-control"
                      name="description"
                      id="description"
            >{{$booking->description ?? null}}</textarea>
        </div>
    </div>
</div>
@push('styles')
    <style>
        @media (min-width: 992px) {
            .p-md-6rem {
                padding-left: 6rem
            }
        }
    </style>
@endpush()
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.5.11/full-all/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            if ($("#description").length > 0) {
                CKEDITOR.replace('description');
            }
            $('input[type="radio"]').on('click', function () {
                console.log($(this).val() === 'manual')
                if ($(this).val() === 'manual') {
                    $('#schedule_manual').removeClass('hide');
                } else {

                    $('#schedule_manual').val('').addClass('hide')
                }
            })
        })
        $('form input').on('keypress', function (e) {
            return e.which !== 13;
        });
    </script>
@endpush

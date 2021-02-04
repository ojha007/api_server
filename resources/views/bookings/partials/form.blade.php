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
            <input class="form-control"
                   type="date"
                   required
                   name="moving_date"
                   id="moving_date"
                   style=" margin-top: 5px">
        </div>
    </div>
    {!! Form::bsText('moving_from_suburb',old('moving_from_suburb'),['p'=>6]) !!}
    {!! Form::bsText('moving_to_suburb',old('moving_to_suburb'),['p'=>6]) !!}
    {!! Form::bsText('pickup_address',old('pickup_address'),['p'=>6]) !!}

    <div class="form-group col-md-6 col-sm-12 p-sm-0">
        <div class="col-md-3 col-sm-12">
            <label for="size_of_moving">Size of moving</label>
        </div>
        <div class="col-md-9 col-sm-12 @error('size_of_moving') has-error @enderror">
            {!! Form::select('size_of_moving',\App\Models\Booking::allSizeOfMoving(),null,['class'=>'form-control','placeholder'=>'Select Moving Size']) !!}
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
{{--            {!! Form::select('additional_service',\App\Models\Booking::allAdditionalServices(),null,--}}
{{--                ['class'=>'form-control','placeholder'=>'Select Moving Size']) !!}--}}
        </div>
    </div>
    {!! Form::bsText('dropoff_address',old('dropoff_address'),['p'=>6]) !!}
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
                      type="datetime-local"
                      name="description"
                      id="description"
            ></textarea>
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
    </script>
@endpush

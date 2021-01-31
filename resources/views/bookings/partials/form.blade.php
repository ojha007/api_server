@php $user=['1'=>1] @endphp
<div class="box-body">
    {!! Form::bsText('name',old('name'),['p'=>6]) !!}
    {!! Form::bsEmail('email',old('email'),['p'=>6]) !!}
    {!! Form::bsText('phone',old('phone'),['p'=>6]) !!}
    <div class="form-group col-md-6 col-sm-12">
        <div class="col-md-3 col-sm-12">
            <label for="moving_date">Moving Date :</label>
        </div>
        <div class="col-md-9 col-sm-12">
            <input class="form-control"
                   type="datetime-local"
                   name="moving_date"
                   id="moving_date" value=" {{old('moving_date')}}"
                   style=" margin-top: 5px">
        </div>
    </div>
    {!! Form::bsText('moving_from_suburb',old('moving_from_suburb'),['p'=>6]) !!}
    {!! Form::bsText('moving_to_suburb',old('moving_to_suburb'),['p'=>6]) !!}
    {!! Form::bsText('pickup_address',old('pickup_address'),['p'=>6]) !!}
    {!! Form::bsText('dropoff_address',old('dropoff_address'),['p'=>6]) !!}
    {!! Form::bsText('additional_address',old('additional_address'),['p'=>6]) !!}
    {!! Form::bsText('access_parking',old('access_parking'),['p'=>6]) !!}
    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-1 col-sm-12">
            <label for="description">Description:</label>
        </div>
        <div class="col-md-11 col-sm-12 p-md-4">
            <textarea class="form-control"
                      type="datetime-local"
                      name="moving_date"
                      id="description"
                      style=" margin-top: 5px"></textarea>
        </div>
    </div>
</div>
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

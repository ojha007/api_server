@php $user=['1'=>1] @endphp
<div class="box-body">
    {!! Form::bsEmail('title',old('title'),['p'=>3]) !!}
    {!! Form::bsEmail('address',old('address'),['p'=>3]) !!}
    {{--    {!! Form::bsText('description',old('description'),['p'=>3]) !!}--}}
    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-2 col-sm-12">
            <label for="schedule">User</label>
        </div>
        <div class="col-md-9 col-sm-12">
            {!! Form::select('user_id', $user, null ,array('placeholder' => 'Select User','class' => 'form-control select2','style'=>'width:100%;')) !!}
        </div>
    </div>
    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-2 col-sm-12">
            <label for="schedule">Start Time :</label>
        </div>
        <div class="col-md-9 col-sm-12">
            <input class="form-control"
                   type="datetime-local"
                   name="start_time"
                   id="start_time" value=" {{old('start_time')}}"
                   style=" margin-top: 5px">
        </div>
    </div>
    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-2 col-sm-12">
            <label for="schedule">End Time :</label>
        </div>
        <div class="col-md-9 col-sm-12">
            <input class="form-control"
                   type="datetime-local"
                   name="end_time"
                   id="end_time" value="{{old('end_time')}}"
                   style="margin-top: 5px">
        </div>
    </div>
    <div class="col-md-12"></div>
    {!! Form::bsTextArea('description') !!}

</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.5.11/full-all/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            if ($("#message").length > 0) {
                CKEDITOR.replace('message');
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

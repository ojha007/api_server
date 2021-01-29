<div class="box-body">
    {!! Form::bsEmail('from_email',old('from_email'),['p'=>3]) !!}
    {!! Form::bsText('subject',old('subject'),['p'=>3]) !!}
    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-2 col-sm-12">
            <label for="schedule">Schedule :</label>
        </div>
        <div class="col-md-9">
            <div class="radio">
                <label>
                    <input type="radio" name="schedule_time" value="now" checked="checked">
                    Send Immediately
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="schedule_time" value="manual" id="manual">
                    Deliver at following time
                </label>
                <label for="schedule_manual"></label>
                <input class="form-control hide"
                       type="datetime-local"
                       name="schedule"
                       id="schedule_manual"
                       style="margin-top: 5px">
            </div>
        </div>
    </div>
    <div class="col-md-12"></div>
    {!! Form::bsTextArea('message') !!}

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

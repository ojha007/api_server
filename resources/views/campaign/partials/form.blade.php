<div class="box-body">
    {!! Form::bsEmail('from_email') !!}
    <div class="col-md-12"></div>
    {!! Form::bsText('subject') !!}
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
        })
    </script>
@endpush

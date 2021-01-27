{!! Form::bsText('title',old('test'),['autofocus']) !!}
<div class="col-md-12" style="padding: 0">
    {!! Form::bsTextArea('description',old('description')) !!}
</div>
@push('scripts')
    <script src="{{asset('backend/js/ckeditor.js')}}" rel="script"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            // CKEDITOR.replace('description')

        })
    </script>
@endpush


{!! Form::bsText('title',old('title'),['autofocus']) !!}
{!! Form::bsTextArea('description',old('description')) !!}
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


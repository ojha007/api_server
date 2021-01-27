<div class="row">
    <div class="box-body">

        {!! Form::bsText('name',old('name'),['autofocus']) !!}
        {!! Form::bsText('email',old('email'),['autofocus']) !!}
        {!! Form::bsText('phone',old('phone'),['autofocus']) !!}
        {{--{!! Form::bsText('name',old('name'),['autofocus']) !!}--}}
    </div>
    <div class="box-footer">
        <button
            type="button"
            onclick="window.history.back()"
            class="btn btn-flat btn-default pull-left">
            Close
        </button>
        <button
            type="submit"
            class="btn btn-primary btn-flat pull-right">
            {{$text ?? 'Submit'}}
        </button>
    </div>
</div>

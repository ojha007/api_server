@extends('mails.partials.menu')
@section('mailbox')
    <div id='mailbox' class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$title ?? ''}}</h3>
                <div class="box-tools pull-right">
                    {{ \LaravelGmail::user() }}
                    @if(\LaravelGmail::check())
                        <a href="{{ url('oauth/gmail/logout') }}" class="btn btn-danger btn-flat">
                           Logout
                        </a>
                    @else
                        <a href="{{ url('oauth/gmail') }}" class="btn  btn-flat btn-primary">
                            Login
                        </a>
                    @endif

                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" id="email">

                <!-- /.mail-box-messages -->
            </div>
{{--            <div class="overlay">--}}
{{--                <i class="fa fa-refresh fa-spin"></i>--}}
{{--            </div>--}}
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
@endsection
@push('scripts')
    @include('mails.scripts',['url'=>$url])
@endpush

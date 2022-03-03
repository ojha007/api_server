@extends('mails.partials.menu')
@section('mailbox')
    <div id='mailbox' class="col-md-10">
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
            <dashboard-mail url="{{route('mails.inbox')}}"
                            logged="{{\LaravelGmail::check()}}">
            </dashboard-mail>
            <!-- /.box-header -->
{{--            <div class="box-body " id="email">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xs-12 text-center">--}}
{{--                        @if(\LaravelGmail::check())--}}
{{--                            <button type="button" class="btn btn-default btn-lg">--}}
{{--                                <i class="fa fa-spin fa-refresh"></i>&nbsp; Loading Mails--}}
{{--                            </button>--}}

{{--                        @else--}}
{{--                            <a href="{{ url('oauth/gmail') }}" class="nav-link">Login to Your gmail account</a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.mail-box-messages -->--}}
{{--            </div>--}}
        {{--            <div class="overlay">--}}
        {{--                <i class="fa fa-refresh fa-spin"></i>--}}
        {{--            </div>--}}
        <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
@endsection
{{--@push('scripts')--}}
{{--    @include('mails.scripts',['url'=>$url])--}}
{{--@endpush--}}

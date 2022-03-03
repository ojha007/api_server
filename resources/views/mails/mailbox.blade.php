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

        </div>
        <!-- /. box -->
    </div>
@endsection


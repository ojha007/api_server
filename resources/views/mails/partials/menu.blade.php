@extends('layouts.master')
@section('title_postfix') | MailBox @endsection
@section('header') MailBox @endsection
@section('subHeader') List of Mail @endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="row">
        <div class="col-md-1">
            <div id="mailbox_option" class="box  box-solid">
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="{{request()->routeIs('mails.inbox','mails.index') ?'active' : ''}}">
                            <a href="{{route('mails.index')}}"><i
                                    class="fa fa-inbox"></i> Inbox
                            </a></li>
                        <li class="{{request()->routeIs('mails.sent') ?'active' : ''}}">
                            <a href="{{route('mails.sent')}}"><i
                                    class="fa fa-envelope-o"></i>Sent</a></li>

                        <li class="{{request()->routeIs('mails.draft') ?'active' : ''}}">
                            <a href="{{route('mails.draft')}}"><i class="fa fa-file-text-o"></i> Drafts</a>
                        </li>
                        <li class="{{request()->routeIs('mails.junk') ?'active' : ''}}">
                            <a href="#"><i class="fa fa-filter"></i> Junk</a>
                        </li>
                        <li class="{{request()->routeIs('mails.trash') ?'active' : ''}}">
                            <a href="{{route('mails.trash')}}"><i class="fa fa-trash-o"></i> Trash</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <!-- /.box -->
        </div>
    @yield('mailbox')
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.btnCompose').on('click', function () {
                $('#compose').removeClass('hide');
                $('#mailbox').addClass('hide');
            });
            $('#mailbox_option li').on('click', function () {
                $('#compose').addClass('hide');
                $('#mailbox').removeClass('hide');
            });
        })
    </script>
@endpush()

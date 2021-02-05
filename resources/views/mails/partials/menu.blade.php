@extends('layouts.master')
@section('title_postfix') | MailBox @endsection
@section('header') MailBox @endsection
@section('subHeader') List of Mail @endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <a
                href="{{route('mails.compose')}}"
                class="btn btn-primary  btn-block"
                style="margin-bottom: 2rem;">Compose
            </a>

            <div id="mailbox_option" class="box  box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Folders</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
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

    <!-- /.col -->
    {{--        <div id='mailbox' class="col-md-9">--}}
    {{--            <div class="box box-primary">--}}
    {{--                <div class="box-header with-border">--}}
    {{--                    <h3 class="box-title">Sent Notification</h3>--}}

    {{--                    <div class="box-tools pull-right">--}}
    {{--                        <div class="has-feedback">--}}
    {{--                            <input type="text" class="form-control input-sm" placeholder="Search Mail">--}}
    {{--                            <span class="glyphicon glyphicon-search form-control-feedback"></span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <!-- /.box-tools -->--}}
    {{--                </div>--}}
    {{--                <!-- /.box-header -->--}}
    {{--                <div class="box-body no-padding">--}}

    {{--                    <div class="table-responsive mailbox-messages">--}}
    {{--                        <table class="table table-hover table-striped">--}}
    {{--                            @forelse($unreadMails as $mail)--}}
    {{--                                @php($data = json_decode($mail->data))--}}
    {{--                                <tr>--}}
    {{--                                    <td>{{explode('\\', $mail->type)[2]}}</td>--}}
    {{--                                    <td>--}}
    {{--                                        {{$data->name ?? ''}}--}}
    {{--                                    </td>--}}
    {{--                                    <td>--}}
    {{--                                        {{$data->email ?? ''}}--}}
    {{--                                    </td>--}}
    {{--                                    <td>--}}
    {{--                                        {{\Illuminate\Support\Carbon::parse($mail->created_at)->diffForHumans()}}--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}
    {{--                            @empty--}}
    {{--                                <tr>--}}
    {{--                                    <td>--}}
    {{--                                        No Mail is recorded.--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}
    {{--                            @endforelse--}}
    {{--                        </table>--}}
    {{--                        <!-- /.table -->--}}
    {{--                    </div>--}}
    {{--                    <!-- /.mail-box-messages -->--}}
    {{--                </div>--}}
    {{--                <!-- /.box-body -->--}}
    {{--                <div class="box-footer no-padding">--}}
    {{--                    <div class="mailbox-controls">--}}
    {{--                        <!-- Check all button -->--}}

    {{--                        <!-- /.pull-right -->--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <!-- /. box -->--}}
    {{--        </div>--}}
    {{--        <div id="compose" class="col-md-9 hide">--}}
    {{--            <div class="box box-primary">--}}
    {{--                <div class="box-header with-border">--}}
    {{--                    <h3 class="box-title">Compose New Message</h3>--}}
    {{--                </div>--}}
    {{--                <!-- /.box-header -->--}}
    {{--                <div class="box-body">--}}
    {{--                    <div class="form-group">--}}
    {{--                        <label for="to">To:</label>--}}
    {{--                        <input class="form-control" name="to" type="email" placeholder="To:" id="to">--}}
    {{--                    </div>--}}
    {{--                    <div class="form-group">--}}
    {{--                        <label for="subject">Subject:</label>--}}
    {{--                        <input class="form-control" type="text" id="subject" name="subject" placeholder="Subject:">--}}
    {{--                    </div>--}}
    {{--                    <div class="form-group">--}}
    {{--                        <label for="message">Message:</label>--}}
    {{--                        <textarea name="message" id="message" class="form-control" rows="10"></textarea>--}}
    {{--                    </div>--}}
    {{--                    <div class="form-group">--}}
    {{--                        <div class="btn btn-default btn-file">--}}
    {{--                            <i class="fa fa-paperclip"></i> Attachment--}}
    {{--                            <input type="file" name="attachment">--}}
    {{--                        </div>--}}
    {{--                        <p class="help-block">Max. 32MB</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <!-- /.box-body -->--}}
    {{--                <div class="box-footer">--}}
    {{--                    <div class="pull-right">--}}
    {{--                        <button type="button" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i> Draft--}}
    {{--                        </button>--}}
    {{--                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-envelope-o"></i> Send--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                    <button type="reset" class="btn btn-default btn-flat"><i class="fa fa-times"></i> Discard</button>--}}
    {{--                </div>--}}
    {{--                <!-- /.box-footer -->--}}
    {{--            </div>--}}
    {{--        </div>--}}
    <!-- /.col -->
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

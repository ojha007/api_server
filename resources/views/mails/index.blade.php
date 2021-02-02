@extends('layouts.master')
@section('title_postfix') | MailBox @endsection
@section('header') MailBox @endsection
@section('subHeader') List of Mail @endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="#" class="btn btn-primary btn-block"
               style="margin-bottom: 3rem;">Compose</a>

            <div class="box box-solid">
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
                        <li><a href="#"><i class="fa fa-inbox"></i> Inbox
                            </a></li>
                        <li class="active"><a href="#"><i class="fa fa-envelope-o"></i>Sent</a></li>

                        <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                        <li><a href="#"><i class="fa fa-filter"></i> Junk</a>
                        </li>
                        <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sent Notification</h3>

                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" placeholder="Search Mail">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">

                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            @forelse($unreadMails as $mail)
                                @php($data = json_decode($mail->data))
                                <tr>
                                    <td>{{explode('\\', $mail->type)[2]}}</td>
                                    <td>
                                        {{$data->name ?? ''}}
                                    </td>
                                    <td>
                                        {{$data->email ?? ''}}
                                    </td>
                                    <td>
                                        {{\Illuminate\Support\Carbon::parse($mail->created_at)->diffForHumans()}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        No Mail is recorded.
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->

                        <!-- /.pull-right -->
                    </div>
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

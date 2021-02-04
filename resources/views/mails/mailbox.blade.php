@extends('mails.partials.menu')
@section('mailbox')
    <div id='mailbox' class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$title ?? ''}}</h3>

                <div class="box-tools pull-right">
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Search Mail">
                        <span class="fa fa-search form-control-feedback"></span>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">

                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        @forelse($mails as $mail)
                            <tr>
                                <td>{{$mail->to}}</td>
                                <td>
                                    {{$mail->subject}}
                                </td>
                                <td>
                                    {{\Illuminate\Support\Carbon::parse($mail->created_at)->diffForHumans()}}
                                </td>
                                <td>
                                    <a href="" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if($mail->draft)
                                        <a href="{{route('mails.edit',$mail->id)}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                    @if(!$mail->draft)
                                        <a href="{{route('mails.copy',$mail->id)}}" title="Copy">
                                            <i class="fa fa-copy"></i>
                                        </a>
                                    @endif
                                    <a href="" title="Trash">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center">
                                    No {{$title ?? 'Mail'}} is recorded.
                                </td>
                            </tr>
                        @endforelse
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
@endsection

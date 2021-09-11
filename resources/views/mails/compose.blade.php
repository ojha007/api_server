@extends('mails.partials.menu')
@section('mailbox')
    <div id="compose" class="col-md-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Compose New Message</h3>
            </div>
            {!! Form::open(['route'=>isset($mail) && isset($edit) ? ['mails.update',$mail->id]:  'mails.sent',
                    'enctype'=>"multipart/form-data" ]) !!}
                @if(isset($mail) && isset($edit))
                    @method('PATCH')
                @endisset
            <div class="box-body">
                <div class="form-group col-md-6">
                    <label for="to">From Mail:</label>
                    {!! Form::email('fromEmail',config('app.fromEmail'),['class'=>'form-control','placeholder'=>'From Email:','required']) !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="to">From Name:</label>
                    {!! Form::text('fromName',config('app.fromName'),['class'=>'form-control','placeholder'=>'From Name:','required']) !!}
                </div>
                <div class="form-group">
                    <label for="to">To:</label>
                    {!! Form::email('to',$mail->to ?? null,['class'=>'form-control','placeholder'=>'To:','required']) !!}
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    {!! Form::text('subject',$mail->subject ?? null,['class'=>'form-control','placeholder'=>'Subject:','required']) !!}
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <input type="hidden" name="draft" value="0">
                    {!! Form::textarea('message',$mail->message ?? null,['class'=>'form-control','placeholder'=>'Write message here .........']) !!}
                </div>
                <div class="form-group">
                    <div class="btn btn-default btn-file btn-flat">
                        <i class="fa fa-paperclip"></i> Attachment
                        <input type="file" name="attachments[]" multiple>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-flat">
                        <i class="fa fa-envelope-o"></i> Send
                    </button>
                </div>
                <button type="reset" class="btn btn-default btn-flat">
                    <i class="fa fa-times"></i> Discard
                </button>
            </div>
        {!! Form::close() !!}
        <!-- /.box-footer -->
        </div>
    </div>
@endsection


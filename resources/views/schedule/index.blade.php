@extends('layouts.master')
@section('title_postfix') | Event & Schedule @endsection
@section('breadcrumb') @endsection
@section('header')
    Event & Schedule
@endsection
@section('subHeader')
    Event & Schedule
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="modal right fade" id="task_modal" tabindex="-1" role="dialog" aria-labelledby="task_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-flat btn-default pull-right" data-dismiss="modal"
                            aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal-title" id="task_modal_title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="border-bottom: 1px solid bisque">
                        <div class="col-md-12">
                            <div id="assignedWorker" class="col-md-9 form-group"></div>
                            {!! Form::open(['route'=>'tasks.assigned']) !!}
                            <div class="form-group col-md-9">
                                <label for="worker_id">Assign To Worker</label>
                                {!! Form::select('worker_id',$workers ,null,['class'=>'form-control','placeholder'=>'Select Worker']) !!}
                                <input type="hidden" name="task_id" value="">
                            </div>
                            <div class="col-md-3 form-group pull-left">
                                <label></label>
                                <button
                                    id="assignBtn"
                                    class="btn btn-flat btn-primary pull-left"
                                    style="margin-top: 1.8em;">
                                    Assign
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="padding: 1em">

                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/css/calendar.css')}}"/>
    <style>
        .modal.right.fade .modal-dialog {
            right: -320px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.right.fade.in .modal-dialog {
            right: 0;
        }

        .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            width: 40%;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.right .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.right .modal-body {
            padding: 15px 15px 80px;
        }

    </style>
@endpush
@push('scripts')
    <script src="{{asset('backend/js/calendar.js')}}" type="text/javascript"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                selectable: true,
                editable: true,
                droppable: true,
                drop: function (arg) {
                    if (document.getElementById('drop-remove').checked) {
                        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                    }
                },
                eventClick: function (info) {
                    $.ajax({
                        url: '{{url('tasks')}}' + '/' + info.event.id,
                        type: 'GET',
                        success: function (response) {

                            let modal = $('#task_modal');
                            $('#task_modal_title').html(response.title);
                            modal.find('form input[name="task_id"]').val(response['id']);
                            if (response['workers'].length) {
                                let o = ' <label>Assigned Worker</label>';
                                response['workers'].forEach(worker => {
                                    o += `<input type="text" readonly value="${worker.name}" class="form-control disabled">`
                                });
                                $('#assignedWorker').html(o);
                            }
                            let template = `{{view('schedule.sidebarModal')}}`
                            $('.modal-body>div:nth-child(2)>div').html(template)
                            modal.modal('show')
                        }
                    });
                },
                dayMaxEvents: true,
                events: "{{route('tasks.calendar')}}"
            });
            calendar.render();
            let task_model = $('#task_modal');
            let submitBtn = $('#assignBtn');
            task_model.find('form').on('submit', function (e) {
                e.preventDefault();
                submitBtn.attr('disabled', 'disabled')
                let ele = $(this);
                $(this).find('select[name="worker_id"]').parent().removeClass('has-error');
                $(this).find('select[name="worker_id"]').siblings('.help-block').remove();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'task_id': $(this).find('input[name="task_id"]').val(),
                        'worker_id': $(this).find('select[name="worker_id"]').val()
                    },
                    success: function (response) {
                        if (response.data.code === 201) {
                            ele.closest('.modal-body')
                                .prepend(`
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                <p>User Assigned Successfully</p>
                            </div>
                            `)
                        }
                        submitBtn.removeAttr('disabled')
                    },
                    error: function (errors) {
                        if (errors['responseJSON']) {
                            let error = errors['responseJSON'].errors['worker_id'];
                            let e = $(task_model).find('select[name="worker_id"]');
                            e.parent('div').addClass('has-error');
                            $(`<span class="help-block">${error}</span>`).insertAfter(e);
                        }
                        submitBtn.removeAttr('disabled')
                    },

                });
                setTimeout(function () {
                    ele.find('.alert').addClass('hide')
                }, 500)
            });
            task_model.on('hide.bs.modal', function () {
                $(this).find('.alert').remove();
                $(this).find('select[name="worker_id"]').val('');
                $(this).find('select[name="worker_id"]').parent().removeClass('has-error');
                $(this).find('select[name="worker_id"]').siblings('.help-block').remove();
                $('#assignedWorker').html('');
                submitBtn.removeAttr('disabled')
            })
        });
    </script>
@endpush

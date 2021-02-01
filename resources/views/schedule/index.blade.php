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
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Draggable Schedule</h4>
                </div>
                <div class="box-body">
                    <!-- the events -->
                    <div id="external-events">
                        <div class="external-event bg-green ui-draggable ui-draggable-handle"
                             style="position: relative;">Lunch
                        </div>
                        <div class="external-event bg-yellow ui-draggable ui-draggable-handle"
                             style="position: relative;">Go home
                        </div>
                        <div class="external-event bg-aqua ui-draggable ui-draggable-handle"
                             style="position: relative;">Do homework
                        </div>
                        <div class="external-event bg-light-blue ui-draggable ui-draggable-handle"
                             style="position: relative;">Work on UI design
                        </div>
                        <div class="external-event bg-red ui-draggable ui-draggable-handle" style="position: relative;">
                            Sleep tight
                        </div>
                        <div class="checkbox">
                            <label for="drop-remove">
                                <input type="checkbox" id="drop-remove">
                                remove after drop
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Schedule</h3>
                </div>
                <div class="box-body">
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                        <ul class="fc-color-picker" id="color-chooser">
                            <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
                    <div class="input-group">
                        <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                        <div class="input-group-btn">
                            <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                        </div>
                        <!-- /btn-group -->
                    </div>
                    <!-- /input-group -->
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
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
{{--                    <div class="btn-group pull-right">--}}
{{--                        <button type="button" class="btn btn-flat btn-default dropdown-toggle" data-toggle="dropdown">--}}
{{--                            <span class="caret"></span>--}}
{{--                        </button>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li><a href="#">Assign To Worker</a></li>--}}
{{--                            <li>--}}
{{--                                <a href="#" data-dismiss="modal">--}}
{{--                                    Close--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                        <button type="button" class="btn btn-flat btn-default pull-right"  data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
{{--                    </div>--}}
                    <h4 class="modal-title" id="task_modal_title"></h4>
                </div>

                <div class="modal-body">
                    <div class="row" style="border-bottom: 1px solid bisque">
                        {{--                        <div class="col-md-6">--}}
                        <div class="form-group col-md-6">
                            <label for="worker_id">Assign To Worker</label>
                            {!! Form::select('worker_id',[],null,['class'=>'form-control','placeholder'=>'Select Worker']) !!}
                        </div>
                        <div class="col-md-2 form-group">
                            <label></label>
                            <button class="btn btn-flat btn-default pull-right" style="margin-top: 1.6em;">
                                Assign
                            </button>
                        </div>
                        {{--                        </div>--}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
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
            const events = document.getElementById('external-events');
            new FullCalendar.Draggable(events, {
                itemSelector: '.external-event',
                eventData: function (eventEl) {
                    return {
                        title: eventEl.innerText.trim(),
                    }
                }
            });
            // $('#task_modal').find('.dropdown-menu >li:first-child').on('click', function () {
            //     $('#assign_task').modal('show')
            // })
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
                            $('#task_modal_title').html(response.title)
                            let template = `<p>Name: ${response['booking'][0]['name']}</p>`
                            $('.modal-body>div:nth-child(2)>div').html(template)
                            // $('.modal-body').html(response);
                            $('#task_modal').modal('show')
                        }
                    });
                },
                dayMaxEvents: true,
                events: "{{route('tasks.calendar')}}"
            });
            calendar.render();
        });
    </script>
@endpush

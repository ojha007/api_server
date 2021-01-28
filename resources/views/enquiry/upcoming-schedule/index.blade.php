@extends('layouts.master')
@section('title_postfix') | Upcoming Schedule @endsection
@section('breadcrumb') @endsection
@section('header')
    Schedule
@endsection
@section('subHeader')
    Schedule
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
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/css/calendar.css')}}"/>
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

            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                editable: true,
                droppable: true,
                drop: function (arg) {
                    if (document.getElementById('drop-remove').checked) {
                        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                    }
                },
                eventClick: function (arg) {
                    if (confirm('Are you sure you want to delete this event?')) {
                        arg.event.remove()
                    }
                },
                dayMaxEvents: true,
                events: [
                    {
                        title: 'Long Event',
                        start: '2021-01-07',
                        end: '2021-01-10',
                        class: 'bg-red'

                    }
                ]

            });
            calendar.render();
        });
    </script>
@endpush

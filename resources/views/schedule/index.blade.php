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
    <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
                </div>

                <div class="modal-body">
                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                        3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                        laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                        anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                        occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard
                        of them accusamus labore sustainable VHS.
                    </p>
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
        {{--async function getAllTasks() {--}}
        {{--    return $.ajax({--}}
        {{--        'url': '{{route('tasks.index')}}',--}}
        {{--        'method': 'GET',--}}
        {{--        'success': function (response) {--}}
        {{--            return response;--}}
        {{--        },--}}
        {{--        'error': function (error) {--}}
        {{--            console.log(error)--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}
        {{--var SITEURL = "{{route('tasks.index')}}";--}}

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
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
                selectable: true,
                editable: true,
                droppable: true,
                drop: function (arg) {
                    if (document.getElementById('drop-remove').checked) {
                        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                    }
                },
                eventClick: function (arg) {
                    $('#myModal2').modal('show')
                    // if (confirm('Are you sure you want to delete this event?')) {
                    //     arg.event.remove()
                    // }
                },
                dayMaxEvents: true,
                events: "{{route('tasks.calendar')}}"
            });
            calendar.render();
        });
    </script>
@endpush

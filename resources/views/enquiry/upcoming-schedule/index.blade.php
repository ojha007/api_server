@extends('layouts.master')
@section('title_postfix') | Upcoming Schedule @endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default">
        <div class="box-body no-padding">
            <!-- THE CALENDAR -->
            <div id="calendar" class="fc fc-unthemed fc-ltr">
                <div class="fc-toolbar fc-header-toolbar">
                    <div class="fc-left">
                        <div class="fc-button-group">
                            <button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left"
                                    aria-label="prev"><span class="fc-icon fc-icon-left-single-arrow"></span></button>
                            <button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right"
                                    aria-label="next"><span class="fc-icon fc-icon-right-single-arrow"></span></button>
                        </div>
                        <button type="button"
                                class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled"
                                disabled="">today
                        </button>
                    </div>
                    <div class="fc-right">
                        <div class="fc-button-group">
                            <button type="button"
                                    class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">
                                month
                            </button>
                            <button type="button" class="fc-agendaWeek-button fc-button fc-state-default">week</button>
                            <button type="button"
                                    class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">
                                day
                            </button>
                        </div>
                    </div>
                    <div class="fc-center"><h2>January 2021</h2></div>
                    <div class="fc-clear"></div>
                </div>
                <div class="fc-view-container" style="">
                    <div class="fc-view fc-month-view fc-basic-view" style="">
                        <table class="">
                            <thead class="fc-head">
                            <tr>
                                <td class="fc-head-container fc-widget-header">
                                    <div class="fc-row fc-widget-header">
                                        <table class="">
                                            <thead>
                                            <tr>
                                                <th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th>
                                                <th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th>
                                                <th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th>
                                                <th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th>
                                                <th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th>
                                                <th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th>
                                                <th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                            <tbody class="fc-body">
                            <tr>
                                <td class="fc-widget-content">
                                    <div class="fc-scroller fc-day-grid-container"
                                         style="overflow: hidden; height: 765.556px;">
                                        <div class="fc-day-grid fc-unselectable">
                                            <div class="fc-row fc-week fc-widget-content" style="height: 127px;">
                                                <div class="fc-bg">
                                                    <table class="">
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day fc-widget-content fc-sun fc-other-month fc-past"
                                                                data-date="2020-12-27"></td>
                                                            <td class="fc-day fc-widget-content fc-mon fc-other-month fc-past"
                                                                data-date="2020-12-28"></td>
                                                            <td class="fc-day fc-widget-content fc-tue fc-other-month fc-past"
                                                                data-date="2020-12-29"></td>
                                                            <td class="fc-day fc-widget-content fc-wed fc-other-month fc-past"
                                                                data-date="2020-12-30"></td>
                                                            <td class="fc-day fc-widget-content fc-thu fc-other-month fc-past"
                                                                data-date="2020-12-31"></td>
                                                            <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                data-date="2021-01-01"></td>
                                                            <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                data-date="2021-01-02"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-top fc-sun fc-other-month fc-past"
                                                                data-date="2020-12-27"><span
                                                                    class="fc-day-number">27</span>
                                                            </td>
                                                            <td class="fc-day-top fc-mon fc-other-month fc-past"
                                                                data-date="2020-12-28"><span
                                                                    class="fc-day-number">28</span>
                                                            </td>
                                                            <td class="fc-day-top fc-tue fc-other-month fc-past"
                                                                data-date="2020-12-29"><span
                                                                    class="fc-day-number">29</span>
                                                            </td>
                                                            <td class="fc-day-top fc-wed fc-other-month fc-past"
                                                                data-date="2020-12-30"><span
                                                                    class="fc-day-number">30</span>
                                                            </td>
                                                            <td class="fc-day-top fc-thu fc-other-month fc-past"
                                                                data-date="2020-12-31"><span
                                                                    class="fc-day-number">31</span>
                                                            </td>
                                                            <td class="fc-day-top fc-fri fc-past"
                                                                data-date="2021-01-01">
                                                                <span class="fc-day-number">1</span></td>
                                                            <td class="fc-day-top fc-sat fc-past"
                                                                data-date="2021-01-02">
                                                                <span class="fc-day-number">2</span></td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"
                                                                    style="background-color:#f56954;border-color:#f56954">
                                                                    <div class="fc-content"><span
                                                                            class="fc-time">12a</span>
                                                                        <span class="fc-title">All Day Event</span>
                                                                    </div>
                                                                </a></td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week fc-widget-content" style="height: 127px;">
                                                <div class="fc-bg">
                                                    <table class="">
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                data-date="2021-01-03"></td>
                                                            <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                data-date="2021-01-04"></td>
                                                            <td class="fc-day fc-widget-content fc-tue fc-past"
                                                                data-date="2021-01-05"></td>
                                                            <td class="fc-day fc-widget-content fc-wed fc-past"
                                                                data-date="2021-01-06"></td>
                                                            <td class="fc-day fc-widget-content fc-thu fc-past"
                                                                data-date="2021-01-07"></td>
                                                            <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                data-date="2021-01-08"></td>
                                                            <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                data-date="2021-01-09"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-top fc-sun fc-past"
                                                                data-date="2021-01-03">
                                                                <span class="fc-day-number">3</span></td>
                                                            <td class="fc-day-top fc-mon fc-past"
                                                                data-date="2021-01-04">
                                                                <span class="fc-day-number">4</span></td>
                                                            <td class="fc-day-top fc-tue fc-past"
                                                                data-date="2021-01-05">
                                                                <span class="fc-day-number">5</span></td>
                                                            <td class="fc-day-top fc-wed fc-past"
                                                                data-date="2021-01-06">
                                                                <span class="fc-day-number">6</span></td>
                                                            <td class="fc-day-top fc-thu fc-past"
                                                                data-date="2021-01-07">
                                                                <span class="fc-day-number">7</span></td>
                                                            <td class="fc-day-top fc-fri fc-past"
                                                                data-date="2021-01-08">
                                                                <span class="fc-day-number">8</span></td>
                                                            <td class="fc-day-top fc-sat fc-past"
                                                                data-date="2021-01-09">
                                                                <span class="fc-day-number">9</span></td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week fc-widget-content" style="height: 127px;">
                                                <div class="fc-bg">
                                                    <table class="">
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                data-date="2021-01-10"></td>
                                                            <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                data-date="2021-01-11"></td>
                                                            <td class="fc-day fc-widget-content fc-tue fc-past"
                                                                data-date="2021-01-12"></td>
                                                            <td class="fc-day fc-widget-content fc-wed fc-past"
                                                                data-date="2021-01-13"></td>
                                                            <td class="fc-day fc-widget-content fc-thu fc-past"
                                                                data-date="2021-01-14"></td>
                                                            <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                data-date="2021-01-15"></td>
                                                            <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                data-date="2021-01-16"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-top fc-sun fc-past"
                                                                data-date="2021-01-10">
                                                                <span class="fc-day-number">10</span></td>
                                                            <td class="fc-day-top fc-mon fc-past"
                                                                data-date="2021-01-11">
                                                                <span class="fc-day-number">11</span></td>
                                                            <td class="fc-day-top fc-tue fc-past"
                                                                data-date="2021-01-12">
                                                                <span class="fc-day-number">12</span></td>
                                                            <td class="fc-day-top fc-wed fc-past"
                                                                data-date="2021-01-13">
                                                                <span class="fc-day-number">13</span></td>
                                                            <td class="fc-day-top fc-thu fc-past"
                                                                data-date="2021-01-14">
                                                                <span class="fc-day-number">14</span></td>
                                                            <td class="fc-day-top fc-fri fc-past"
                                                                data-date="2021-01-15">
                                                                <span class="fc-day-number">15</span></td>
                                                            <td class="fc-day-top fc-sat fc-past"
                                                                data-date="2021-01-16">
                                                                <span class="fc-day-number">16</span></td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week fc-widget-content" style="height: 127px;">
                                                <div class="fc-bg">
                                                    <table class="">
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                data-date="2021-01-17"></td>
                                                            <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                data-date="2021-01-18"></td>
                                                            <td class="fc-day fc-widget-content fc-tue fc-past"
                                                                data-date="2021-01-19"></td>
                                                            <td class="fc-day fc-widget-content fc-wed fc-past"
                                                                data-date="2021-01-20"></td>
                                                            <td class="fc-day fc-widget-content fc-thu fc-past"
                                                                data-date="2021-01-21"></td>
                                                            <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                data-date="2021-01-22"></td>
                                                            <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                data-date="2021-01-23"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-top fc-sun fc-past"
                                                                data-date="2021-01-17">
                                                                <span class="fc-day-number">17</span></td>
                                                            <td class="fc-day-top fc-mon fc-past"
                                                                data-date="2021-01-18">
                                                                <span class="fc-day-number">18</span></td>
                                                            <td class="fc-day-top fc-tue fc-past"
                                                                data-date="2021-01-19">
                                                                <span class="fc-day-number">19</span></td>
                                                            <td class="fc-day-top fc-wed fc-past"
                                                                data-date="2021-01-20">
                                                                <span class="fc-day-number">20</span></td>
                                                            <td class="fc-day-top fc-thu fc-past"
                                                                data-date="2021-01-21">
                                                                <span class="fc-day-number">21</span></td>
                                                            <td class="fc-day-top fc-fri fc-past"
                                                                data-date="2021-01-22">
                                                                <span class="fc-day-number">22</span></td>
                                                            <td class="fc-day-top fc-sat fc-past"
                                                                data-date="2021-01-23">
                                                                <span class="fc-day-number">23</span></td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="fc-event-container" colspan="2"><a
                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-not-end fc-draggable"
                                                                    style="background-color:#f39c12;border-color:#f39c12">
                                                                    <div class="fc-content"><span
                                                                            class="fc-time">12a</span>
                                                                        <span class="fc-title">Long Event</span></div>
                                                                </a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week fc-widget-content" style="height: 127px;">
                                                <div class="fc-bg">
                                                    <table class="">
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                data-date="2021-01-24"></td>
                                                            <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                data-date="2021-01-25"></td>
                                                            <td class="fc-day fc-widget-content fc-tue fc-past"
                                                                data-date="2021-01-26"></td>
                                                            <td class="fc-day fc-widget-content fc-wed fc-today "
                                                                data-date="2021-01-27"></td>
                                                            <td class="fc-day fc-widget-content fc-thu fc-future"
                                                                data-date="2021-01-28"></td>
                                                            <td class="fc-day fc-widget-content fc-fri fc-future"
                                                                data-date="2021-01-29"></td>
                                                            <td class="fc-day fc-widget-content fc-sat fc-future"
                                                                data-date="2021-01-30"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-top fc-sun fc-past"
                                                                data-date="2021-01-24">
                                                                <span class="fc-day-number">24</span></td>
                                                            <td class="fc-day-top fc-mon fc-past"
                                                                data-date="2021-01-25">
                                                                <span class="fc-day-number">25</span></td>
                                                            <td class="fc-day-top fc-tue fc-past"
                                                                data-date="2021-01-26">
                                                                <span class="fc-day-number">26</span></td>
                                                            <td class="fc-day-top fc-wed fc-today "
                                                                data-date="2021-01-27">
                                                                <span class="fc-day-number">27</span></td>
                                                            <td class="fc-day-top fc-thu fc-future"
                                                                data-date="2021-01-28">
                                                                <span class="fc-day-number">28</span></td>
                                                            <td class="fc-day-top fc-fri fc-future"
                                                                data-date="2021-01-29">
                                                                <span class="fc-day-number">29</span></td>
                                                            <td class="fc-day-top fc-sat fc-future"
                                                                data-date="2021-01-30">
                                                                <span class="fc-day-number">30</span></td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-event-container" rowspan="2"><a
                                                                    class="fc-day-grid-event fc-h-event fc-event fc-not-start fc-end fc-draggable"
                                                                    style="background-color:#f39c12;border-color:#f39c12">
                                                                    <div class="fc-content"><span class="fc-title">Long Event</span>
                                                                    </div>
                                                                </a></td>
                                                            <td rowspan="2"></td>
                                                            <td rowspan="2"></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"
                                                                    style="background-color:#0073b7;border-color:#0073b7">
                                                                    <div class="fc-content"><span
                                                                            class="fc-time">10:30a</span> <span
                                                                            class="fc-title">Meeting</span></div>
                                                                </a></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"
                                                                    href="http://google.com/"
                                                                    style="background-color:#3c8dbc;border-color:#3c8dbc">
                                                                    <div class="fc-content"><span
                                                                            class="fc-time">12a</span>
                                                                        <span class="fc-title">Click for Google</span>
                                                                    </div>
                                                                </a></td>
                                                            <td rowspan="2"></td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"
                                                                    style="background-color:#00c0ef;border-color:#00c0ef">
                                                                    <div class="fc-content"><span
                                                                            class="fc-time">12p</span>
                                                                        <span class="fc-title">Lunch</span></div>
                                                                </a></td>
                                                            <td class="fc-event-container"><a
                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"
                                                                    style="background-color:#00a65a;border-color:#00a65a">
                                                                    <div class="fc-content"><span
                                                                            class="fc-time">7p</span>
                                                                        <span class="fc-title">Birthday Party</span>
                                                                    </div>
                                                                </a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="fc-row fc-week fc-widget-content" style="height: 130px;">
                                                <div class="fc-bg">
                                                    <table class="">
                                                        <tbody>
                                                        <tr>
                                                            <td class="fc-day fc-widget-content fc-sun fc-future"
                                                                data-date="2021-01-31"></td>
                                                            <td class="fc-day fc-widget-content fc-mon fc-other-month fc-future"
                                                                data-date="2021-02-01"></td>
                                                            <td class="fc-day fc-widget-content fc-tue fc-other-month fc-future"
                                                                data-date="2021-02-02"></td>
                                                            <td class="fc-day fc-widget-content fc-wed fc-other-month fc-future"
                                                                data-date="2021-02-03"></td>
                                                            <td class="fc-day fc-widget-content fc-thu fc-other-month fc-future"
                                                                data-date="2021-02-04"></td>
                                                            <td class="fc-day fc-widget-content fc-fri fc-other-month fc-future"
                                                                data-date="2021-02-05"></td>
                                                            <td class="fc-day fc-widget-content fc-sat fc-other-month fc-future"
                                                                data-date="2021-02-06"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="fc-content-skeleton">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <td class="fc-day-top fc-sun fc-future"
                                                                data-date="2021-01-31">
                                                                <span class="fc-day-number">31</span></td>
                                                            <td class="fc-day-top fc-mon fc-other-month fc-future"
                                                                data-date="2021-02-01"><span
                                                                    class="fc-day-number">1</span>
                                                            </td>
                                                            <td class="fc-day-top fc-tue fc-other-month fc-future"
                                                                data-date="2021-02-02"><span
                                                                    class="fc-day-number">2</span>
                                                            </td>
                                                            <td class="fc-day-top fc-wed fc-other-month fc-future"
                                                                data-date="2021-02-03"><span
                                                                    class="fc-day-number">3</span>
                                                            </td>
                                                            <td class="fc-day-top fc-thu fc-other-month fc-future"
                                                                data-date="2021-02-04"><span
                                                                    class="fc-day-number">4</span>
                                                            </td>
                                                            <td class="fc-day-top fc-fri fc-other-month fc-future"
                                                                data-date="2021-02-05"><span
                                                                    class="fc-day-number">5</span>
                                                            </td>
                                                            <td class="fc-day-top fc-sat fc-other-month fc-future"
                                                                data-date="2021-02-06"><span
                                                                    class="fc-day-number">6</span>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@push('scripts')
    <script>
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            //Random default events
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    backgroundColor: '#f56954', //red
                    borderColor: '#f56954' //red
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    backgroundColor: '#f39c12', //yellow
                    borderColor: '#f39c12' //yellow
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    backgroundColor: '#0073b7', //Blue
                    borderColor: '#0073b7' //Blue
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    backgroundColor: '#00c0ef', //Info (aqua)
                    borderColor: '#00c0ef' //Info (aqua)
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                    backgroundColor: '#00a65a', //Success (green)
                    borderColor: '#00a65a' //Success (green)
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/',
                    backgroundColor: '#3c8dbc', //Primary (light-blue)
                    borderColor: '#3c8dbc' //Primary (light-blue)
                }
            ],
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject')

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject)

                // assign it the date that was reported
                copiedEventObject.start = date
                copiedEventObject.allDay = allDay
                copiedEventObject.backgroundColor = $(this).css('background-color')
                copiedEventObject.borderColor = $(this).css('border-color')

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove()
                }

            }
        })

    </script>
@endpush

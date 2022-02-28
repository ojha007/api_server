<div class="modal fade in" id="modal-booking-assigned">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Assign Booking</h4>
            </div>
            {!! Form::open(['route'=>'tasks.assigned']) !!}
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="booking_id" value="{{$booking->id}}">
                    <div class="form-group col-md-12">
                        <div class="col-md-2">
                            <label for="Select Workers">Select Worker</label>
                        </div>
                        <div class="col-md-10 form-group">
                            {!! Form::select('worker_id',$workers,
                               $booking->task ? !$booking->task->workers->isEmpty() ? $booking->task->workers->first()->pluck('id') : null:null ,
                               ['class'=>'form-control','placeholder'=>'Select Workers',]) !!}
                            <input type="hidden" name="task_id" value="{{$booking->task ? $booking->task->id:null}}">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-flat btn-primary">Confirmed</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

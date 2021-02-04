<div class="modal fade in" id="modal-booking-confirm">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Booking</h4>
            </div>
            {!! Form::open(['route'=>'bookings.confirmed']) !!}
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="booking_id" value="{{$booking->id}}">
                    <div class="form-group col-md-12">
                        <div class="col-md-2">
                            <label for="amount">Payment</label>
                        </div>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="number" class="form-control" id="amount" name="amount">
                                <span class="input-group-addon">
                                    <select name="payment_currency">
                                        <option value="AUD">AUD</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-2">
                            <label for="time">Time:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="time" class="form-control" id="time" name="time">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-2">
                            <label for="quotes">Quotes:</label>
                        </div>
                        <div class="col-md-10">
                            <textarea name="quotes" id="quotes" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat pull-left"
                        data-dismiss="modal">Reject
                </button>
                <button type="submit" class="btn btn-flat btn-primary">Confirmed</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

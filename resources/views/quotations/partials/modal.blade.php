<div class="modal fade" id="quotation-create">
    <div class="modal-dialog modal-lg">
        {!! Form::open(['route'=>'quotations.store']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create New Quotation</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                   @include('quotations.partials.form')
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left btn-flat"
                        data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

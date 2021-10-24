<div class="box-body">
    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-2 col-sm-12">
            <label for="title">Title:</label>
        </div>
        <div class="col-md-10 col-sm-12 p-md-6rem ">
            {{Form::text('title',null,['class'=>'form-control'])}}

        </div>
    </div>

    <div class="form-group col-md-12 col-sm-12">
        <div class="col-md-2 col-sm-12">
            <label for="comments">Description:</label>
        </div>
        <div class="col-md-10 col-sm-12 p-md-6rem ">
            {{Form::textarea('description',null,['class'=>'form-control','rows'=>'4'])}}

        </div>
    </div>
</div>

@if($task->images()->exists())
    @if($task->images->where('type',$type)->count())
        <div class="col-xs-12">
            <h2 class="page-header">
                <b>{{$title}}:</b>
            </h2>
        </div>
        <div class="row flex">
            @foreach($task->images as $image)
                <div class="col-lg-4 col-sm-6">
                    <div class="thumbnail">
                        <img src="{{url($image->url)}}" class="img-fluid" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endif

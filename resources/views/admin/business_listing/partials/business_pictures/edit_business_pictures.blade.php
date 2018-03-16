<div class="box-header">
   <a href="{{ route('admin.new_picture_form', ['slug' => $businessListing->slug]) }}" class="btn bg-olive btn-flat">Add New Picture</a>
</div>


@if(@sizeof($businessPictures))
@foreach($businessPictures as $loopingPictures)

	<div class="col-xs-12 col-sm-6 col-md-3 img_{{ $loopingPictures->id }}">
	   <div class="thumbnail-pic">
	      <div class="thumbnail">
	         <img id="image_src" src="{{ asset('/uploads/businessAvatars/'.$loopingPictures->avatar) }}">
	      </div>
	      <div class="caption">
	         <a href="javascript:void(0);" class="btn btn-danger delete_picture" data-id="{{ $loopingPictures->id }}"><i class="fa fa-trash-o"></i> </a>
	         <a href="javascript:void(0);" class="btn btn-danger" data-toggle="confirmation"><i class="fa fa-trash-o"></i> </a>
	      </div>
	   </div>
	</div>

@endforeach
@endif

<p class="dum @if(@sizeof($businessPictures)) hide @endif">No Pictures Found.</p>
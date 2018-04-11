<div class="box-header yauzer-1">
   <h3>Yauzers</h3>	
   <a href="{{ route('admin.new_yauzer_form', ['slug' => $businessListing->slug]) }}" class="btn bg-olive btn-flat">Add Yauzer</a>
</div>


@if(@sizeof($businessYauzersInfo))
	<div class="row">
		<div class="col-sm-12">
			<ul class="commentboxlist">
				@foreach($businessYauzersInfo as $loopingYauzer)
				<li id="yauzer_li_{{ $loopingYauzer->id }}">

					<figure><img class="img-circle" src="/uploads/avatars/{{ $loopingYauzer->user->avatar }}" style="height: 75px; width: 75px;" alt="{{ $loopingYauzer->user->name }}"></figure>
					<div class="commentbox-content">
						<h5 class="authorname">{{ $loopingYauzer->user->name }}</h5>
						<div class="star-rating">
							<input id="input-21e" value="{{ $loopingYauzer->rating }}" type="text" class="rating" data-min=0 data-max=5 data-step=0.5 data-size="xs" title="" disabled="disabled">
						</div>
						<p>{{ $loopingYauzer->yauzer }}</p>
					</div>
                <div class="button-box">
					<button class="btn btn-danger btn-flat delete_yauzer" data-id="{{ $loopingYauzer->id }}" data-toggle="tooltip" title="" data-original-title="Delete Yauzer"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

					<a href="{{ route('admin.edit_yauzer',[ 'yauzer_id' => $loopingYauzer->id, 'slug' => $businessListing->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="" data-original-title="Edit Yauzer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif



<p class="dum @if(@sizeof($businessYauzersInfo)) hide @endif">No yauzer found for this business.</p>
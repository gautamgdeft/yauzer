<div class="box-header">
   <a href="{{ route('admin.show_business_description_form', ['slug' => $businessListing->slug]) }}" class="btn bg-olive btn-flat">Add Yauzer</a>
</div>


{{-- @if(@sizeof($businessYauzersInfo))

 <p>{{ $businessListing->description }}</p>

@endif --}}
@if(@sizeof($businessYauzersInfo))
	<div class="row">
		<div class="col-sm-12">
			<ul class="commentboxlist">
				@foreach($businessYauzersInfo as $loopingYauzer)
				<li>
					<figure><img class="img-circle" src="/uploads/avatars/{{ $loopingYauzer->user->avatar }}" style="height: 45px; width: 45px;" alt="{{ $loopingYauzer->user->name }}"></figure>
					<div class="commentbox-content">
						<h5 class="authorname">{{ $loopingYauzer->user->name }}</h5>
						<div class="star-rating">
							<input id="input-21e" value="{{ $loopingYauzer->rating }}" type="text" class="rating" data-min=0 data-max=5 data-step=0.5 data-size="xs" title="" disabled="disabled">
						</div>
						<p>{{ $loopingYauzer->yauzer }}</p>
					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif



{{-- <p class="dum @if(@sizeof($businessListing->description)) hide @endif">No description found for this business.</p> --}}
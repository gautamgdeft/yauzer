<div class="box-header speciality-1">
   <h3>Specialties</h3>	
   <a href="{{ route('admin.new_speciality_form', ['slug' => $businessListing->slug]) }}" class="btn bg-olive btn-flat">Add Speciality</a>
</div>


@if(@sizeof($businessSpecialitiesInfo))
	<div class="row">
		<div class="col-sm-12">
			<ul class="speciality_checks">
				@foreach($businessSpecialitiesInfo as $loopingSpecialties)
				<li id="speciality_li_{{ $loopingSpecialties->id }}">

					<div class="commentbox-content">
                         <p>{{ $loopingSpecialties->name }}</p>
					</div>

					<button class="btn btn-danger btn-flat delete_speciality" data-id="{{ $loopingSpecialties->id }}" data-toggle="tooltip" title="" data-original-title="Delete Speciality"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

					<a href="{{ route('admin.edit_speciality',[ 'speciality_slug' => $loopingSpecialties->slug, 'slug' => $businessListing->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="" data-original-title="Edit Speciality"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

				</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif



<p class="dum @if(@sizeof($businessSpecialitiesInfo)) hide @endif">No speciality found for this business.</p>
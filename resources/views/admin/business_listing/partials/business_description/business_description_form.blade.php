<div class="box-header">
   <a href="{{ route('admin.show_business_description_form', ['slug' => $businessListing->slug]) }}" class="btn bg-olive btn-flat">Edit</a>
</div>


@if(@sizeof($businessListing->description))

 <p>{{ $businessListing->description }}</p>

@endif

<p class="dum @if(@sizeof($businessListing->description)) hide @endif">No description found for this business.</p>
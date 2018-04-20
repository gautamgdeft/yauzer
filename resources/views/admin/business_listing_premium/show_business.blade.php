@extends('layouts.admin')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> View Business Details </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">View Business Details</li>
      </ol>
   </section>

   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box">
               <div class="users view large-9 medium-8 columns content col-md-7 col-sm-12 col-xs-12">
                  <!-- <h3>113</h3> -->
                  <table class="vertical-table table table-bordered">
                     <tr>
                        <th scope="row">ID</th>
                        <td>{{ $businessListing->id }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Name</th>
                        <td>{{ $businessListing->name }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Business Owner</th>
                        <td>@if(@sizeof($businessListing->user)){{ $businessListing->user->name }}@else No Owner Yet @endif</td>
                     </tr>                      

                     <tr>
                        <th scope="row">Business Added By</th>
                        <td>@if(@sizeof($businessListing->business_added_by)){{ $businessListing->business_added_by->name }}@else No User Yet @endif</td>
                     </tr>                         
                      
                     <tr>
                        <th scope="row">Business Category</th>
                        <td>{{ $businessListing->category->name }}</td>
                     </tr>                      
                      
                     <tr>
                        <th scope="row">Business Subcategory</th>
                        <td>
                           @if(@sizeof($business_subcategories))
                            @foreach($business_subcategories as $loopingSubcategories)
                             {{ $loopingSubcategories }}@if (!$loop->last),@endif 
                            @endforeach
                           @else
                             No subcategories found
                           @endif 
                        </td>
                     </tr>                     

                     <tr>
                        <th scope="row">Address</th>
                        <td>{{ $businessListing->address }}</td>
                     </tr>

                     <tr>
                        <th scope="row">City</th>
                        <td>{{ $businessListing->city }}</td>
                     </tr>

                     <tr>
                        <th scope="row">State</th>
                        <td>{{ $businessListing->state }}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">Country</th>
                        <td>{{ $businessListing->country }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Zipcode</th>
                        <td>{{ $businessListing->zipcode }}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">Website</th>
                        <td>{{ $businessListing->website }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Description</th>
                        <td>{!! html_entity_decode($businessListing->description) !!}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">Business Status</th>
                        <td>@if($businessListing->status == '1')Active Business @else Inactive Business @endif</td>
                     </tr>

                     <tr>
                        <th scope="row">Business Image</th>
                        <td><img id="image_src" class="img-circle" src="/uploads/businessAvatars/{{ $businessListing->avatar }}" style="height: 45px; width: 45px;"></td>
                     </tr>

                  </table>

               </div>
            </div>
            <!-- /.box -->
         </div>
      </div>
   </section>
</section>
<!-- /.content -->            
</aside>
@endsection

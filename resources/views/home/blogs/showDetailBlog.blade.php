@extends('layouts.user')
@section('content')
<div class="container">
   <div class="row storage-units2 single-blog-post">
      <div class="col-md-9 col-sm-9">
         <div class="col-md-12 col-sm-12 col-xs-12">
            @if(@sizeof($singleBlog))
            <div class="blog-post">
               <h1 class="blog-title">
                  <div class="dateboard">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $singleBlog->created_at)->format('M') }}<br><span>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $singleBlog->created_at)->day }}</span></span></div>
                  {{ $singleBlog->title }}
               </h1>
               <h2 class="date"></h2>
               <div class="blog-img-view">
                  <img src="/uploads/blogavatars/{{ $singleBlog->avatar }}" alt="img">
               </div>
               <p class="blog-content">{!! $singleBlog->description !!}</p>
            </div>
            @endif
         </div>
      </div>
             @include('home/blogs/blogsidebar')
   </div>
</div>
@endsection
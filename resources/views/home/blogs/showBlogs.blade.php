@extends('layouts.user')
@section('content')
<div class="yauzer-blog-heading">
   <div class="text-center heading-text">
      <hr>
      <h2 class="sec-title blog-header pos-rel"> Yauzer  <span>Blog</span></h2>
   </div>
</div>
<div class="container">
   <div class="row storage-units2">
      <div class="col-md-9 col-sm-9 margin-bottom">
         <div class="col-md-12 col-sm-12 col-xs-12">
            @if(@sizeof($blogs))
            @foreach($blogs as $loopingBlogs)
            <div class="blog-post">
               <div class="blog-title">

                  <div class="dateboard">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->format('M') }}<br><span>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->day }}</span></div>
                  <a class="cstm-blog-title" href="{{ route('showsingleBlog',['slug' => $loopingBlogs->slug]) }}"> {{ $loopingBlogs->title }} </a>
                  <h4 class="date">Posted by: {{ @sizeof($loopingBlogs->blogcontributor) ? $loopingBlogs->blogcontributor->title : 'Admin' }}&nbsp;&nbsp;&nbsp;&nbsp;{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->format('F') }} {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->day }}, {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->year }}
               </h4>
               </div>
               <div class="blog-img-view">
                  <a href="{{ route('showsingleBlog',['slug' => $loopingBlogs->slug]) }}"><img src="/uploads/blogavatars/{{ $loopingBlogs->avatar }}" alt="img"></a>
               </div>
               <p class="blog-content">{!! \Illuminate\Support\Str::words($loopingBlogs->description, 70, '...') !!}</p>
               <a class="post-link" href="{{ route('showsingleBlog',['slug' => $loopingBlogs->slug]) }}">Read More...</a>
            </div>
            @endforeach
            @endif
         </div>

         @if(@sizeof($blogs) > 9)
         <div class="col-sm-12 text-center pagination-ceontent margin-bottom">

               @if($blogs){!! $blogs->render() !!}@endif

         </div>
         @endif
      </div>

      @include('home/blogs/blogsidebar')

   </div>
</div>
@endsection
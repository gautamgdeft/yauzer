      <div class="col-md-3 col-sm-3">
         <div class="custom-sidebar">

            @if(\Request::route()->getName() == 'showsingleBlog')
            <div class="custom-social-icon">
               <h2>Share</h2>
               <ul>
                  <li><a target="_blank" href="http://www.facebook.com/sharer.php?u={{ Request::url() }}" rel="nofollow " data-site="facebook" data-facebook-title="{{ $singleBlog->title }}"><span><i class="fa fa-facebook-square" aria-hidden="true"></i></span></a></li>

                  <li><a target="_blank" href="{{ Share::load(Request::url(), $singleBlog->title)->twitter() }}" rel="nofollow" data-site="twitter"><span><i class="fa fa-twitter-square" aria-hidden="true"></i>
                     </span></a>
                  </li>

                  <li><a target="_blank" href="{{ Share::load(Request::url(), $singleBlog->title)->gplus() }}" rel="nofollow " data-site="google_plus"><span><i class="fa fa-google-plus-square" aria-hidden="true"></i>
                     </span></a>
                  </li>

                  <li><a target="_blank" href="{{ Share::load(Request::url(), $singleBlog->title)->linkedin() }}" rel="nofollow " data-site="linkedin"><span><i class="fa fa-linkedin-square" aria-hidden="true"></i>
                     </span></a>
                  </li>

               </ul>
            </div>       
            @endif

            <div class="custom-recent-post">
               <h2>Recent Posts</h2>
               <ul>
                  @if(@sizeof($blogs))
                  @foreach($blogs as $key => $loopingBlogs)
                  @if($key <= 4)          
                  <li>
                     <figure><a href="{{ route('showsingleBlog',['slug' => $loopingBlogs->slug]) }}"><img id="file-image" alt="Preview" src="/uploads/blogavatars/{{ $loopingBlogs->avatar }}" /></a></figure>
                     <figcaption> {{ $loopingBlogs->title }}
                        <a href="{{ route('showsingleBlog',['slug' => $loopingBlogs->slug]) }}"><span><i class="fa fa-clock-o" aria-hidden="true"></i>
                        </span>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->format('F') }} {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->day }}, {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->year }}</a>
                     </figcaption>
                  </li>
                  @endif
                  @endforeach
                  @endif
               </ul>
            </div>

            <div class="custom-categories-post">
               <h2>Categories</h2>
               <ul>
                  @if(sizeof($categoriesGroupedBlogs))
                  @foreach($categoriesGroupedBlogs as $groupedBlogs)
                  <li><a href="{{ route('categoryfilterBlogs',['categoryid' => $groupedBlogs->id]) }}"><span><i class="fa fa-hand-o-right" aria-hidden="true"></i>
                     </span>{{ $groupedBlogs->name }}</a><small>({{ $groupedBlogs->total }})</small>
                  </li>
                  @endforeach
                  @endif
               </ul>
            </div>
         </div>
      </div>
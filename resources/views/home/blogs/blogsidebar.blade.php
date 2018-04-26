      <div class="col-md-3 col-sm-3">
         <div class="custom-sidebar">
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
{{--             <div class="custom-archives-post">
               <h2>Archives</h2>
               <select id="archieve-select">
                  <option value="">Select Month</option>
                  <option value='https://ezstorit.com/4/2015' >April 2015  (6)</option>
                  <option value='https://ezstorit.com/8/2015' >August 2015  (2)</option>
                  <option value='https://ezstorit.com/12/2015' >December 2015  (1)</option>
                  <option value='https://ezstorit.com/2/2015' >February 2015  (1)</option>
                  <option value='https://ezstorit.com/1/2015' >January 2015  (2)</option>
                  <option value='https://ezstorit.com/6/2015' >June 2015  (3)</option>
                  <option value='https://ezstorit.com/3/2015' >March 2015  (1)</option>
                  <option value='https://ezstorit.com/5/2015' >May 2015  (4)</option>
                  <option value='https://ezstorit.com/11/2015' >November 2015  (1)</option>
                  <option value='https://ezstorit.com/10/2015' >October 2015  (1)</option>
                  <option value='https://ezstorit.com/9/2015' >September 2015  (1)</option>
                  <option value='https://ezstorit.com/4/2016' >April 2016  (4)</option>
                  <option value='https://ezstorit.com/8/2016' >August 2016  (4)</option>
                  <option value='https://ezstorit.com/12/2016' >December 2016  (3)</option>
                  <option value='https://ezstorit.com/2/2016' >February 2016  (1)</option>
                  <option value='https://ezstorit.com/1/2016' >January 2016  (1)</option>
                  <option value='https://ezstorit.com/7/2016' >July 2016  (2)</option>
                  <option value='https://ezstorit.com/6/2016' >June 2016  (3)</option>
                  <option value='https://ezstorit.com/3/2016' >March 2016  (2)</option>
                  <option value='https://ezstorit.com/5/2016' >May 2016  (2)</option>
                  <option value='https://ezstorit.com/11/2016' >November 2016  (1)</option>
                  <option value='https://ezstorit.com/9/2016' >September 2016  (2)</option>
                  <option value='https://ezstorit.com/4/2017' >April 2017  (2)</option>
                  <option value='https://ezstorit.com/8/2017' >August 2017  (3)</option>
                  <option value='https://ezstorit.com/2/2017' >February 2017  (1)</option>
                  <option value='https://ezstorit.com/1/2017' >January 2017  (1)</option>
                  <option value='https://ezstorit.com/7/2017' >July 2017  (1)</option>
                  <option value='https://ezstorit.com/6/2017' >June 2017  (2)</option>
                  <option value='https://ezstorit.com/3/2017' >March 2017  (1)</option>
                  <option value='https://ezstorit.com/5/2017' >May 2017  (1)</option>
                  <option value='https://ezstorit.com/10/2017' >October 2017  (1)</option>
               </select>
            </div> --}}
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
@extends('layouts.owner')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Biz Yauzers </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Biz Yauzers</li>
      </ol>
   </section>
   <div id="msgs">
      @if(session('success'))
      <div class="alert alert-success">
         {{ session('success') }}
      </div>
      @endif
   </div>
   <section class="content">
      <div class="box">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="option-store x_panel">
               <div class="box-header yauzer-1">
                  <h3>Yauzers</h3>
                  {{-- <a href="{{ route('admin.new_yauzer_form', ['slug' => $business->slug]) }}" class="btn bg-olive btn-flat">Add Yauzer</a> --}}
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

                           @if(@sizeof($loopingYauzer->yauzer_comment))
                           <div class="owner-reply">
                           <figure><img class="img-circle" src="/uploads/avatars/{{ $loopingYauzer->yauzer_comment->user->avatar }}" style="height: 75px; width: 75px;" alt="{{ $loopingYauzer->yauzer_comment->user->name }}"></figure>
                           <div class="commentbox-content">
                              <a href="javascript:void;" data-toggle="modal" data-target="#myModal{{ $loopingYauzer->id }}" class="btn btn-warning btn-flat"><i data-toggle="tooltip" title="" data-original-title="Edit Comment" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              <h5 class="authorname">{{ $loopingYauzer->yauzer_comment->user->name }}</h5>
                              <p>{{ $loopingYauzer->yauzer_comment->comment }}</p>
                           </div>
                           </div>
                           @endif

                           <div class="button-box">
                              <a href="javascript:void;" data-toggle="modal" data-target="#myModal{{ $loopingYauzer->id }}" class="btn btn-warning btn-flat" title="" data-original-title="Respond Yauzer"><span data-toggle="tooltip" title="Respond Yauzer" aria-hidden="true">Reply</span></a>
                              <a target="_blank" href="{{ Share::load(route('user.business_detail',['slug' => $loopingYauzer->business->slug]), html_entity_decode(strip_tags(str_replace(['{business_name}','{yauzer}','{business_slug}']  , [$loopingYauzer->business->name, $loopingYauzer->yauzer ,$loopingYauzer->business->slug], $socialShareCms->third_section))))->facebook() }}"><i data-toggle="tooltip" title="Share on Facebook" data-placement="bottom" class="fa fa-facebook" aria-hidden="true"></i></a>                        
                              <a target="_blank" href="{{ Share::load('', html_entity_decode(strip_tags(str_replace(['{business_name}','{yauzer}','{business_slug}']  , [$loopingYauzer->business->name, $loopingYauzer->yauzer ,$loopingYauzer->business->slug], $socialShareCms->third_section))))->twitter() }}"><i data-toggle="tooltip" title="Share on Twitter" data-placement="bottom" class="fa fa-twitter" aria-hidden="true"></i></a>                        
                              <a target="_blank" href="{{ Share::load('', html_entity_decode(strip_tags(str_replace(['{business_name}','{yauzer}','{business_slug}']  , [$loopingYauzer->business->name, $loopingYauzer->yauzer ,$loopingYauzer->business->slug], $socialShareCms->third_section))))->linkedin() }}"><i data-toggle="tooltip" title="Share on Linkedin" data-placement="bottom" class="fa fa-linkedin" aria-hidden="true"></i></a>                              
                           </div>
                        </li>

                        <!--Yauzer Reply Section Modal-->
                        <div id="myModal{{ $loopingYauzer->id }}" class="modal fade" role="dialog">
                           <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{ @sizeof($loopingYauzer->yauzer_comment) ? 'Edit Comment' : 'Respond Yauzer' }}</h4>
                                 </div>
                                 <div class="modal-body">
                                    <form id="{{ $loopingYauzer->id }}" name="respond_yauzer" method="POST" action="{{ route('owner.respond_yauzer') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="yauzer_id" value="{{ $loopingYauzer->id }}">
                                    <input type="hidden" name="business_id" value="{{ $loopingYauzer->business->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <div id="user_yauzer_div" class="form-group">
                                       <label>Yauzer</label>
                                       <input name="yauzer" id="yauzer" class="form-control" value="{{ $loopingYauzer->yauzer }}" disabled>
                                    </div>                                    

                                    <div id="yauzer_div" class="form-group">
                                       <label>Respond Yauzer<span> *</span></label>
                                       <textarea name="comment" id="comment" class="form-control" rows="8" required>@if(@sizeof($loopingYauzer->yauzer_comment)){{ $loopingYauzer->yauzer_comment->comment }}@endif</textarea>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                 	<button type="submit" id="yauzer_edit_btn" onclick="applyValidate({{ $loopingYauzer->id }});" class="btn btn-default">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                             </form>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </ul>
                  </div>
               </div>
               @endif
               <p class="dum @if(@sizeof($businessYauzersInfo)) hide @endif">No yauzer found for this business.</p>
            </div>
         </div>
      </div>
   </section>
</aside>
<!-- /.right-side -->
@endsection
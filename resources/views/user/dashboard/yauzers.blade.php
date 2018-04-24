@extends('layouts.user')
@section('content')
<div class="blog-form-wrapper create-listing list-new">
<div class="container">
   <div class="row profile">
      <div class="col-md-3">
         <!--Adding Dashboard Sidebar Partial--> 
         @include('user/dashboard/partials/dashboard_sidebar')
      </div>
      <div class="col-md-9">
         <div class="profile-content">
            <div id="msgs">
               @if(session('success'))
               <div class="alert alert-success">
                  {{ session('success') }}
               </div>
               @endif
               @if($errors->any())
               <div class="alert alert-danger">
                  {{$errors->first()}}
               </div>
               @endif              
            </div>
            <div class="page-header">
               <h1><small class="pull-right">{{ $yauzers->count() }} Yauzer</small> Yauzers </h1>
            </div>
            <div class="comments-list" id="myList">
               @if(@sizeof($yauzers))
               @foreach($yauzers as $loopingYauzer)
               <div class="media liist">
                  <a class="media-left" href="#">
                  <img class="img-circle" src="/uploads/businessAvatars/{{ $loopingYauzer->business->avatar }}">
                  </a>
                  <div class="media-body cstm-txt">
                     <p class="pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i><small>{{ $loopingYauzer->updated_at->diffForHumans() }}</small></p>
                     <h4 class="media-heading user_name">{{ $loopingYauzer->business->name }}</h4>
                     {{ $loopingYauzer->yauzer }}
                     <small class="edit-text"><a href="javascript:void(0)" data-toggle="modal" data-target="#editYauzer{{ $loopingYauzer->id }}"><i data-toggle="tooltip" title="Edit Yauzer" data-placement="bottom" class="fa fa-pencil-square-o" aria-hidden="true"></i></a></small>
                  </div>
               </div>
               
               <!-- Edit-Yauzer-Modal -->
               <div class="modal fade" id="editYauzer{{ $loopingYauzer->id }}" role="dialog">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Edit Yauzer</h4>
                        </div>
                        <div class="modal-body">
                           <form id="{{ $loopingYauzer->id }}" name="edit_yauzer" method="POST" action="{{ route('user.update_yauzer') }}">
                              {{ csrf_field() }}
                              <input type="hidden" name="id" value="{{ $loopingYauzer->id }}">
                              <div id="yauzer_div" class="form-group">
                                 <label>What makes this business your favorite, give it a Yauz!<span> *</span></label>
                                 <textarea name="yauzer" id="yauzer" class="form-control" rows="8" required>{{ $loopingYauzer->yauzer }}</textarea>
                              </div>
                              <div id="yauzer_div" class="form-group">
                                 <label>Rating</label>
                                 <input id="input-21e" value="{{ $loopingYauzer->rating }}" type="text" class="form-control rating" data-min=0 data-max=5 data-step=1 data-size="xs" name="rating" title="">
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
               @else
               No Yauzer
               @endif
               <div id="loadMore">Load more</div>
               <div id="showLess">Show Less</div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

<style type="text/css">
 
#myList .liist{ display:none;
}
#loadMore {
    color:green;
    cursor:pointer;
}
#loadMore:hover {
    color:black;
}
#showLess {
    color:red;
    cursor:pointer;
}
#showLess:hover {
    color:black;
}

</style>

@section('custom_scripts')
 <script type="text/javascript">
    
$(document).ready(function () {
    size_li = $("#myList .liist").length;
    x=5;
    $('#myList .liist:lt('+x+')').show();
    $('#loadMore').click(function () {
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('#myList .liist:lt('+x+')').show();
    });
    $('#showLess').click(function () {
        x=(x-5<0) ? 3 : x-5;
        $('#myList .liist').not(':lt('+x+')').hide();
    });
});    

 </script>
@endsection
@extends('layouts.owner')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Market it! Get more Yauzers
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Market it! Get more Yauzers</li>
      </ol>
   </section>



	<div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
            </div><!-- /.box-header -->
            <div class="box-body">
			   <img src="{{ asset('images/Market-it.png') }}">
			   <p class="text-aqua">At Yauzer we made it easy for you to share your business and germ or yauzers (reviews). Use the templates below often to increase your visibility and reputation.  Yauzer on!</p>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>	

    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-text-width"></i>
                <h3 class="box-title">Business Share Email Template</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
			   <textarea rows="15" cols="70" style="border:double 4px #85c226;">Subject: {{ Auth::user()->business->name }} Just Joined Yauzer!

Content:
As a loyal customer of {{ Auth::user()->business->name }}, your feedback and support is very important to us. 
We would appreciate if you can share your feedback and show your love by Yauzering us at yauzer.com.

Thank you for being an Ambassador for {{ Auth::user()->business->name }}

Yauzer On!</textarea>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>    


    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-text-width"></i>
                <h3 class="box-title">Business Social Share Template</h3>
				  <a target="_blank" href="{{ Share::load('https://yauzer.com/business-detail/'.Auth::user()->business->slug.'', 'Just joined Yauzer!  Review & Yauz us at Yauzer.com '.Auth::user()->business->name.'
          https://yauzer.com/business-detail/'.Auth::user()->business->slug.'')->facebook() }}"><i data-toggle="tooltip" title="Share on Facebook" data-placement="bottom" class="fa fa-facebook" aria-hidden="true"></i></a>          

                  <a target="_blank" href="{{ Share::load('', 'Just joined Yauzer!  Review & Yauz us at Yauzer.com '.Auth::user()->business->name.'
          https://yauzer.com/business-detail/'.Auth::user()->business->slug.'')->twitter() }}"><i data-toggle="tooltip" title="Share on Twitter" data-placement="bottom" class="fa fa-twitter" aria-hidden="true"></i></a>                       

                  <a target="_blank" href="{{ Share::load('', 'Just joined Yauzer!  Review & Yauz us at Yauzer.com '.Auth::user()->business->name.'
          https://yauzer.com/business-detail/'.Auth::user()->business->slug.'')->linkedin() }}"><i data-toggle="tooltip" title="Share on Linkedin" data-placement="bottom" class="fa fa-linkedin" aria-hidden="true"></i></a>       

            </div><!-- /.box-header -->
            <div class="box-body">
<textarea rows="15" cols="70" style="border:double 4px #85c226;">Just joined Yauzer!  Review & Yauz us at Yauzer.com {{ Auth::user()->business->name }}
          https://yauzer.com/business-detail/{{ Auth::user()->business->slug }}</textarea>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>

</aside>   


@endsection
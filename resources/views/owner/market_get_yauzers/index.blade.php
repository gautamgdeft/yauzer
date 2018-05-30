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
			   <img src="/uploads/siteCMSAvatars/{{ $ownerMarketITcms->default_bg_image }}">
			        {!! $ownerMarketITcms->description_ckeditor !!}
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
			   <textarea class="description-ckeditor" id="business_share_email_editor">{!! str_replace('{business_name}'  , Auth::user()->business->name, $ownerMarketITcms->first_section) !!}</textarea>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>    


    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-text-width"></i>
                <h3 class="box-title">Business Social Share Template</h3>
				  <a target="_blank" href="{{ Share::load('https://yauzer.com/business-detail/'.Auth::user()->business->slug.'', html_entity_decode(strip_tags(str_replace(['{business_name}','{business_slug}']  , [Auth::user()->business->name, Auth::user()->business->slug], $ownerMarketITcms->second_section))))->facebook() }}"><i data-toggle="tooltip" title="Share on Facebook" data-placement="bottom" class="fa fa-facebook" aria-hidden="true"></i></a>          
                  <a target="_blank" href="{{ Share::load('', html_entity_decode(strip_tags(str_replace(['{business_name}','{business_slug}']  , [Auth::user()->business->name, Auth::user()->business->slug], $ownerMarketITcms->second_section))))->twitter() }}"><i data-toggle="tooltip" title="Share on Twitter" data-placement="bottom" class="fa fa-twitter" aria-hidden="true"></i></a>                       

                  <a target="_blank" href="{{ Share::load('', html_entity_decode(strip_tags(str_replace(['{business_name}','{business_slug}']  , [Auth::user()->business->name, Auth::user()->business->slug], $ownerMarketITcms->second_section))))->linkedin() }}"><i data-toggle="tooltip" title="Share on Linkedin" data-placement="bottom" class="fa fa-linkedin" aria-hidden="true"></i></a>       

            </div><!-- /.box-header -->
            <div class="box-body">
<textarea class="description-ckeditor" id="business_social_email_editor">{!! str_replace(['{business_name}','{business_slug}']  , [Auth::user()->business->name, Auth::user()->business->slug], $ownerMarketITcms->second_section) !!}</textarea>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>

</aside>   


@endsection

@section('custom_scripts')
 <script type="text/javascript">
      CKEDITOR.replace( 'business_share_email_editor', {
        extraPlugins: 'justify',
        allowedContent: true
      });
      CKEDITOR.replace( 'business_social_email_editor', {
        extraPlugins: 'justify',
        allowedContent: true
      });         
 </script>
@endsection
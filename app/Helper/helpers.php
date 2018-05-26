<?php

#Upload-User-Avatar-Function
function uploadAvatar($avatar, $user) 
{
	$filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/avatars/' . $filename;
  Image::make($avatar)->resize(300, 300)->save( public_path($path));
  $user->avatar = $filename;
  return true;
}

#Upload-Business-Category-Avatar-Function
function uploadBusinessAvatar($avatar, $business_category) 
{
	$filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/categoryAvatars/' . $filename;
  Image::make($avatar)->save( public_path($path));
  $business_category->update(
   array(
     'avatar' => $filename,
   ));

  return true;
}

#Upload-Business-Subcategory-Avatar-Function
function uploadBusinessSubCatAvatar($avatar, $business_subcategory) 
{
  $filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/subcategoryAvatars/' . $filename;
  Image::make($avatar)->resize(300, 300)->save( public_path($path));
  $business_subcategory->update(
    array(
      'avatar' => $filename,
    ));

  return true;
}

#Upload-Business-Avatar-Function
function uploadBusinessMainAvatar($avatar, $business) 
{
  $filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/businessAvatars/' . $filename;
  Image::make($avatar)->resize(270, 329)->save( public_path($path));
  $business->update(
    array(
      'avatar' => $filename,
    ));

  return true;
}

#Upload-Business-Pictures-Avatar-Function
function uploadBusinessPicturesAvatar($avatar, $business) 
{
  $filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/businessAvatars/' . $filename;
  Image::make($avatar)->resize(475, 283)->save( public_path($path));
  $business->update(
    array(
      'avatar' => $filename,
    ));

  return true;
}

#Upload-Slider-Avatar-Function
function uploadSliderAvatar($avatar, $sliderImage) 
{
  if(!empty($sliderImage->avatar)){
    $path = '/uploads/sliderAvatars/' . $sliderImage->avatar;
    unlink(public_path() . $path);
  }
  $filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/sliderAvatars/' . $filename;
  Image::make($avatar)->resize(1920, 731)->save( public_path($path));
  $sliderImage->update(
   array(
    'avatar' => $filename,
  ));
  return true;
}

#Upload-Blog-Avatar-Function
function uploadBlogAvatar($avatar, $blog) 
{
  $filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/blogavatars/' . $filename;
  Image::make($avatar)->resize(843, 400)->save( public_path($path));
  $blog->update(
    array(
      'avatar' => $filename,
    ));
  return true;
}

#Upload-Business-Default-CMS-Avatar-Function
function uploadBusinessBackgroundImg($avatar, $sitecms) 
{
  $filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/siteCMSAvatars/' . $filename;
  Image::make($avatar)->resize(1920, 485)->save( public_path($path));
  $sitecms->update(
    array(
      'default_bg_image' => $filename,
    ));
  return true;
}

#Upload-Business-Default-CMS-Avatar-Function
function uploadResultBackgroundImg($avatar, $resultcms) 
{
  $filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/siteCMSAvatars/' . $filename;
  Image::make($avatar)->resize(272, 258)->save( public_path($path));
  $resultcms->update(
    array(
      'default_bg_image' => $filename,
    ));
  return true;
}

#Upload-Business-Default-CMS-Avatar-Function
function uploadBusinessComingsoon($avatar, $sitecms) 
{
  $filename = 'coming_soon' . time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/siteCMSAvatars/' . $filename;
  Image::make($avatar)->resize(475, 283)->save( public_path($path));
  $sitecms->update(
    array(
      'picture_coming_soon' => $filename,
    ));
  return true;
}

#Upload-Business-Default-CMS-Avatar-Function
function uploadSignupBackgroundImg($avatar1, $sitecms) 
{
  $filename = 'signup' . '.' . $avatar1->getClientOriginalExtension();
  $path = '/uploads/siteCMSAvatars/' . $filename;
  Image::make($avatar1)->resize(1920, 1006)->save( public_path($path));
  $sitecms->update(
    array(
      'signup_bg_image' => $filename,
    ));
  return true;
}

#Upload-Business-Default-CMS-Avatar-Function
function uploadLoginBackgroundImg($avatar2, $sitecms) 
{
  $filename = 'login' . '.' . $avatar2->getClientOriginalExtension();
  $path = '/uploads/siteCMSAvatars/' . $filename;
  Image::make($avatar2)->resize(1920, 1335)->save( public_path($path));
  $sitecms->update(
    array(
      'login_bg_image' => $filename,
    ));
  return true;
}




#Fetching-Customer-Count-Function
function total_customers()
{
  $users = App\User::whereHas('roles', function($q)
  {
    $q->where('name', 'user');
  })->count(); 

   return $users;    
}

#Fetching-Total-Business-Count-Function
function total_business()
{
  $count = App\BusinessListing::count();
  return $count;  
}

#Fetching-Total-Basic-Business-Count-Function
function total_basic_business()
{
  $count = App\BusinessListing::where('premium_status', false)->count();
  return $count;  
}

#Fetching-Total-Premium-Business-Count-Function
function total_premium_business()
{
  $count = App\BusinessListing::where('premium_status', true)->count();
  return $count;  
}

#Fetching-Yauzers-Count-Function
function total_yauzers()
{
  $count = App\Yauzer::count();
  return $count;    
}

#Fetching-Owners-Count-Function
function total_owners()
{
  $users = App\User::whereHas('roles', function($q)
  {
    $q->where('name', 'owner');
  })->count();  
  
  return $users;    
}

#Fetching-Footer-Menus
function footer_menus()
{
  $footer_menus = App\FooterMenu::where('status', true)->get();
  return $footer_menus;
}

#Fetching-Header-Menus
function header_menus()
{
  $header_menus = App\HeaderMenu::where('status', true)->get();
  return $header_menus;
}

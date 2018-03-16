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
  Image::make($avatar)->resize(300, 300)->save( public_path($path));
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
  Image::make($avatar)->resize(246, 222)->save( public_path($path));
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

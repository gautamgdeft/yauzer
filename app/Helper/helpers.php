<?php

function uploadAvatar($avatar, $user) 
{
	$filename = time() . '.' . $avatar->getClientOriginalExtension();
  $path = '/uploads/avatars/' . $filename;
  Image::make($avatar)->resize(300, 300)->save( public_path($path));
  $user->avatar = $filename;
  return true;
}

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

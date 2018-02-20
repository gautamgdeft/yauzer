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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;

class UserController extends Controller
{
	//ユーザー名の変更
	public function UserNameChange(Request $request)
	{
		$user_id = $request->user_id;
		$user_name = $request->user_name;
		$user_profile = UserProfile::where('user_id', $user_id)->first();
		if (!$user_profile)
        	{
                	return config('error.ERROR_INVALID_DATA');
        	}
		
		$user_profile->user_name = $user_name;
		
		try{
                	$user_profile->save();
        	} catch (\PDOException $e) {
                	return config('error.ERROR_DB_UPDATE');
        	}
		
		$user_profile = UserProfile::where('user_id', $user_id)->first();
		$response = array(
            		"user_profile" => $user_profile,
        	);
		return json_encode($response);
	}

	//ユーザーデータの取得
	public function GetUserData(Request $request)
	{
		$user_id = $request->user_id;
		$user_profile = UserProfile::where('user_id', $user_id)->first();
		if (!$user_profile)
		{
			return config('error.ERROR_INVALID_DATA');
		}
		
		$response = array(
			"user_profile" => $user_profile,
		);
		return json_encode($response);
	}
}

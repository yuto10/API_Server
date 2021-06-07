<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;

class RegistrationController extends Controller
{
    //ユーザーの作成
    public function Registration(Request $request)
	{
		$user_id = uniqid();

		$user_profile = new UserProfile;
		$user_profile->user_id = $user_id;
		$user_profile->user_name = 'user name';

		try {
			$user_profile->save();
		} catch (\PDOException $e) {
			logger($e->getMessage());
			return config('error.ERROR_DB_UPDATE');
		}

		$user_profile = UserProfile::where('user_id', $user_id)->first();

		$response = array(
			'user_profile' => $user_profile,
		);

		return json_encode($response);
	}
}

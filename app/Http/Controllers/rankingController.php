<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\ranking;

class rankingController extends Controller
{
    //ランキングの設定
    public function ranking(Request $request)
    {
	$user_id = $request->user_id;
	$high_score = $request->high_score;
	
	$user_profile = UserProfile::where('user_id', $user_id)->first();
	
	if (!$user_profile) 
	{
		return config('error.ERROR_INVALID_DATA');
	}
	
	$ranking = ranking::where('user_id', $user_id)->first();
	if(!$ranking)
	{
		$ranking = new ranking;
		$ranking->user_id = $user_id;
	}
	$ranking->high_score = $high_score;
	
	try{
		$user_profile->save();
		$ranking->save();
	} catch (\PDOException $e) {
		return config('error.ERROR_DB_UPDATE');
	}
	
	$user_profile = UserProfile::where('user_id', $user_id)->first();
	$ranking = ranking::where('user_id', $user_id)->first();
	$response = array(
	    "user_profile" => $user_profile,
	    "ranking" => $ranking,
	);
	
	return json_encode($response);
    }

    //ランキングの取得
    public function Get(Request $request)
    {
	$cnt = $request->ranking_cnt;
	$ranking = ranking::orderBy('high_score', 'DESC')->take($cnt)->get();
	
	$response = array(
	    "ranking" => $ranking,
	);
	
	return json_encode($response);
    }

    //ユーザースコアの取得
    public function GetUserScore(Request $request)
    {
	$user_id = $request->user_id;
	
	$ranking = ranking::where('user_id', $user_id)->first();
	if(!$ranking)
	{
	    $ranking = new ranking;
	    $ranking->user_id = $user_id;
	    $ranking->high_score = 0;
	}
	
	$response = array(
		"ranking" => $ranking,
	);
	
	return json_encode($response);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
     protected $table = 'user_profile';
	public $incrementing = false;
	protected $primaryKey = 'user_id';
	public $timestamps = false;
}

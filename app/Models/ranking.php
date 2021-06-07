<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ranking extends Model
{
 	protected $table = 'ranking';
	public $incrementing = false;
	protected $primaryKey = 'user_id';
	public $timestamps = false;
}

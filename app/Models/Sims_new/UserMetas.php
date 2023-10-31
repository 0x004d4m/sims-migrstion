<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMetas extends Model
{
	use HasFactory;
	protected $table = 'user_metas';

	protected $connection = 'sims_new';

	protected $fillable = ['id','key','value','object_type','object_id','created_at','updated_at'];

}

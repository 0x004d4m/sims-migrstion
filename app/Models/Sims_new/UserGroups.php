<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroups extends Model
{
	use HasFactory;
	protected $table = 'user_groups';

	protected $connection = 'sims_new';

	protected $fillable = ['id','user_id','group_id','created_at','updated_at'];

}

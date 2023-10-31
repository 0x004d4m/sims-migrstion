<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
	use HasFactory;
	protected $table = 'groups';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','u_id','tenant_id','user_id','location_id','created_at','updated_at'];

}

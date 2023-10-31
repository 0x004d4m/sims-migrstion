<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionGroups extends Model
{
	use HasFactory;
	protected $table = 'permission_groups';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','guard_name','created_at','updated_at','parent_id'];

}

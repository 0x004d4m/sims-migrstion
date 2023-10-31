<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
	use HasFactory;
	protected $table = 'permissions';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','guard_name','created_at','updated_at','group_id'];


	public function group(){return $this->belongsTo(PermissionGroups::class, 'group_id', 'id');}
}

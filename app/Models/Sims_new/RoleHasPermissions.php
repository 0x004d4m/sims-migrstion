<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermissions extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'role_has_permissions';

	protected $connection = 'sims_new';

	protected $fillable = ['permission_id','role_id'];


	public function permission(){return $this->belongsTo(Permissions::class, 'permission_id', 'id');}

	public function role(){return $this->belongsTo(Roles::class, 'role_id', 'id');}
}

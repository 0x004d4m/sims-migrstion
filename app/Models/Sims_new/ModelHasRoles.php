<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRoles extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'model_has_roles';

	protected $connection = 'sims_new';

	protected $fillable = ['role_id','model_type','model_id'];


	public function role(){return $this->belongsTo(Roles::class, 'role_id', 'id');}
}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasPermissions extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'model_has_permissions';

	protected $connection = 'sims_new';

	protected $fillable = ['permission_id','model_type','model_id'];


	public function permission(){return $this->belongsTo(Permissions::class, 'permission_id', 'id');}
}

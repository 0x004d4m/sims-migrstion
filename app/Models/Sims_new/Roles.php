<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
	use HasFactory;
	protected $table = 'roles';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','guard_name','created_at','updated_at','tenant_id'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

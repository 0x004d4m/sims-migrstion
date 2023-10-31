<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimensions extends Model
{
	use HasFactory;
	protected $table = 'dimensions';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','created_at','updated_at','tenant_id'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

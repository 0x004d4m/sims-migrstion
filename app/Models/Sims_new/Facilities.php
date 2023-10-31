<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
	use HasFactory;
	protected $table = 'facilities';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','terms','tenant_id','created_at','updated_at','active'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

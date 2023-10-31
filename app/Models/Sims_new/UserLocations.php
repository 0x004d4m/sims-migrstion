<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocations extends Model
{
	use HasFactory;
	protected $table = 'user_locations';

	protected $connection = 'sims_new';

	protected $fillable = ['id','user_id','location_id','tenant_id','created_at','updated_at'];


	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}

	public function user(){return $this->belongsTo(Users::class, 'user_id', 'id');}
}

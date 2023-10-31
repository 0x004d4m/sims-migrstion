<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypes extends Model
{
	use HasFactory;
	protected $table = 'room_types';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','tenant_id','created_at','updated_at'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomSetups extends Model
{
	use HasFactory;
	protected $table = 'room_setups';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','active','created_at','updated_at','tenant_id'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

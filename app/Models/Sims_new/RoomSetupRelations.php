<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomSetupRelations extends Model
{
	use HasFactory;
	protected $table = 'room_setup_relations';

	protected $connection = 'sims_new';

	protected $fillable = ['id','min_capacity','max_capacity','price_per_person','price_per_hour','room_id','setup_id','active','created_at','updated_at'];


	public function room(){return $this->belongsTo(Rooms::class, 'room_id', 'id');}

	public function setup(){return $this->belongsTo(RoomSetups::class, 'setup_id', 'id');}
}

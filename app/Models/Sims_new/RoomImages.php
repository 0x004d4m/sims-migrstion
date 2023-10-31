<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImages extends Model
{
	use HasFactory;
	protected $table = 'room_images';

	protected $connection = 'sims_new';

	protected $fillable = ['id','url','room_id','sort','created_at','updated_at'];


	public function room(){return $this->belongsTo(Rooms::class, 'room_id', 'id');}
}

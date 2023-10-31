<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
	use HasFactory;
	protected $table = 'rooms';

	protected $connection = 'sims_new';

	protected $fillable = ['id','title','description','type','branch_id','created_at','updated_at','tax_rate','type_id'];


	public function branch(){return $this->belongsTo(Branches::class, 'branch_id', 'id');}

	public function type(){return $this->belongsTo(RoomTypes::class, 'type_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'user_location';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['user_id','location_id'];


	public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}

	public function location(){return $this->belongsTo(Location::class, 'location_id', 'id');}
}

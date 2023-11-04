<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmGroup extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'crm_group';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','name','location_id'];


	public function location(){return $this->belongsTo(Location::class, 'location_id', 'id');}

	public function UserDocument(){return $this->hasOne(UserDocument::class, 'id', 'id');}
}

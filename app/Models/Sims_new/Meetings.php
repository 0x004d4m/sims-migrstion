<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meetings extends Model
{
	use HasFactory;
	protected $table = 'meetings';

	protected $connection = 'sims_new';

	protected $fillable = ['id','object_type','object_id','title','location','description','tenant_id','location_id','assigned_user_id','created_at','updated_at','u_id','related_document','status','meeting_start_date','meeting_end_date'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

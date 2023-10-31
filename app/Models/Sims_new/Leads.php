<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
	use HasFactory;
	protected $table = 'leads';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tenant_id','location_id','assigned_user_id','lead_source_id','lead_status_id','organisation_id','name','email','phone','mobile_number','fax','job_title','website','description','created_at','updated_at','is_converted','payload'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function leadSource(){return $this->belongsTo(LeadsSources::class, 'lead_source_id', 'id');}

	public function leadStatus(){return $this->belongsTo(LeadsStatuses::class, 'lead_status_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function organisation(){return $this->belongsTo(Organisations::class, 'organisation_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

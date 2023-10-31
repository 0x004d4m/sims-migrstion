<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'person';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','first_name','last_name','job_title','reach_details_id','organization_id','address_details_id'];


	public function organization(){return $this->belongsTo(Organization::class, 'organization_id', 'id');}

	public function reachDetail(){return $this->belongsTo(ReachDetails::class, 'reach_details_id', 'id');}

	public function addressDetail(){return $this->belongsTo(AddressDetails::class, 'address_details_id', 'id');}
}

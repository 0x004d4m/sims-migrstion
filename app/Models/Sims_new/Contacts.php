<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'contacts';

	protected $connection = 'sims_new';

	protected $fillable = ['id','mobile_number','alt_mobile_number','type','deleted_at','created_at','updated_at','company_id','tax_rate','tax_number','tax_free','job_title','description','primary_fax','creator_id','assigned_user_id','organisation_id','tenant_id','lead_id','starting_balance','starting_balance_date','currency_id','location_id','first_name','last_name','u_id','account_number'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function company(){return $this->belongsTo(Companies::class, 'company_id', 'id');}

	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function lead(){return $this->belongsTo(Leads::class, 'lead_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function organisation(){return $this->belongsTo(Organisations::class, 'organisation_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

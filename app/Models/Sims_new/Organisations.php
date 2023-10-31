<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisations extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'organisations';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','description','industry_id','tax_free','primary_email','primary_mobile','primary_phone','primary_fax','website','brand_name','registration_number','tax_number','tax_rate','creator_id','assigned_user_id','tenant_id','active','created_at','updated_at','deleted_at','starting_balance','starting_balance_date','currency_id','location_id','u_id','account_number'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function industry(){return $this->belongsTo(Industries::class, 'industry_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

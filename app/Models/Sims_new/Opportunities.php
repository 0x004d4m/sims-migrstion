<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunities extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'opportunities';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tenant_id','name','probability','amount','expected_close_date','campaign','weighted_revenue','description','contact_id','organisation_id','location_id','assigned_user_id','opportunity_source_id','sales_stage_id','currency_id','created_at','updated_at','deleted_at','campaign_id','u_id'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function contact(){return $this->belongsTo(Contacts::class, 'contact_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function opportunitySource(){return $this->belongsTo(OpportunitySources::class, 'opportunity_source_id', 'id');}

	public function organisation(){return $this->belongsTo(Organisations::class, 'organisation_id', 'id');}

	public function salesStage(){return $this->belongsTo(SalesStages::class, 'sales_stage_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

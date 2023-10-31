<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
	use HasFactory;
	protected $table = 'quotes';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tenant_id','location_id','quote_stage_id','assigned_user_id','currency_id','number','subject','expiry_date','sales_order','subtotal_amount','sales_tax_percentage','total_amount','tax_amount','description','created_at','updated_at','opportunity_id','organisation_id','contact_id','u_id'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function contact(){return $this->belongsTo(Contacts::class, 'contact_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function opportunity(){return $this->belongsTo(Opportunities::class, 'opportunity_id', 'id');}

	public function organisation(){return $this->belongsTo(Organisations::class, 'organisation_id', 'id');}

	public function quoteStage(){return $this->belongsTo(QuoteStages::class, 'quote_stage_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'organization';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','brand_name','tax_number','registration_number','name','description','reach_details_id','is_tax_free','shipping_address_details_id','billing_address_details_id','starting_balance','starting_balance_date','currency_id','account_number','industry_option_id'];


	public function shippingAddressDetail(){return $this->belongsTo(AddressDetails::class, 'shipping_address_details_id', 'id');}

	public function reachDetail(){return $this->belongsTo(ReachDetails::class, 'reach_details_id', 'id');}

	public function billingAddressDetail(){return $this->belongsTo(AddressDetails::class, 'billing_address_details_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function industryOption(){return $this->belongsTo(ListOption::class, 'industry_option_id', 'id');}
}

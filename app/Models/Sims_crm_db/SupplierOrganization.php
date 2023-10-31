<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierOrganization extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'supplier_organization';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','name','description','reach_details_id','address_details_id','brand_name','tax_number','registration_number','is_tax_free','starting_balance_date','account_number','starting_balance','currency_id','supplier_category_option_id'];


	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function addressDetail(){return $this->belongsTo(AddressDetails::class, 'address_details_id', 'id');}

	public function reachDetail(){return $this->belongsTo(ReachDetails::class, 'reach_details_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function supplierCategoryOption(){return $this->belongsTo(ListOption::class, 'supplier_category_option_id', 'id');}
}

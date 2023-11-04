<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesContact extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'expenses_contact';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['account_number','description','first_name','last_name','starting_balance','starting_balance_date','is_tax_free','tax_number','id','address_details_id','currency_id','reach_details_id','supplier_category_option_id','brand_name','organization_name','expenses_category_option_id','mode_id'];


	public function expensesCategoryOption(){return $this->belongsTo(ListOption::class, 'expenses_category_option_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function addressDetail(){return $this->belongsTo(AddressDetails::class, 'address_details_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function mode(){return $this->belongsTo(ListOption::class, 'mode_id', 'id');}

	public function reachDetail(){return $this->belongsTo(ReachDetails::class, 'reach_details_id', 'id');}

	public function supplierCategoryOption(){return $this->belongsTo(ListOption::class, 'supplier_category_option_id', 'id');}
}

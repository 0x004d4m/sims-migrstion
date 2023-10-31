<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesAccounts extends Model
{
	use HasFactory;
	protected $table = 'expenses_accounts';

	protected $connection = 'sims_new';

	protected $fillable = ['id','location_id','expenses_category_id','expenses_mode_id','assigned_user_id','tenant_id','organisation_id','first_name','last_name','description','tax_free','primary_email','primary_mobile','primary_phone','primary_fax','website','brand_name','tax_number','tax_rate','active','created_at','updated_at','u_id','organization_name','starting_balance','starting_balance_date','currency_id','account_number'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function expensesCategory(){return $this->belongsTo(ExpensesCategories::class, 'expenses_category_id', 'id');}

	public function expensesMode(){return $this->belongsTo(ExpensesModes::class, 'expenses_mode_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function organisation(){return $this->belongsTo(Organisations::class, 'organisation_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

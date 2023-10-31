<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesPaymentVouchers extends Model
{
	use HasFactory;
	protected $table = 'expenses_payment_vouchers';

	protected $connection = 'sims_new';

	protected $fillable = ['id','location_id','assigned_user_id','expenses_contact_id','expenses_organisation_id','expenses_voucher_id','currency_id','payment_method_id','subject','number','payment_date','description','cash_amount','total_amount','created_at','updated_at','u_id','organization_name','tenant_id','type'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function expensesContact(){return $this->belongsTo(ExpensesAccounts::class, 'expenses_contact_id', 'id');}

	public function expensesOrganisation(){return $this->belongsTo(ExpensesAccounts::class, 'expenses_organisation_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function paymentMethod(){return $this->belongsTo(PaymentMethods::class, 'payment_method_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentExpensesCheckPayment extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'payment_expenses_check_payment';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','bank_name','check_account_name','check_amount','check_due_date','check_number','payment_expenses_id'];


	public function paymentExpense(){return $this->belongsTo(ExpensesPaymentVoucher::class, 'payment_expenses_id', 'id');}
}

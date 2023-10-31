<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesPaymentVoucher extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'expenses_payment_voucher';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['cash_amount','description','number','payment_date','subject','total_amount','id','currency_id','expenses_contact_id','expenses_invoice_id','payment_method_id','expenses_organization_id'];


	public function expensesInvoice(){return $this->belongsTo(ExpensesVoucher::class, 'expenses_invoice_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function paymentMethod(){return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function expensesOrganization(){return $this->belongsTo(ExpensesContact::class, 'expenses_organization_id', 'id');}

	public function expensesContact(){return $this->belongsTo(ExpensesContact::class, 'expenses_contact_id', 'id');}
}

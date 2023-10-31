<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVoucherCheckPayment extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'payment_voucher_check_payment';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','bank_name','check_account_name','check_amount','check_due_date','check_number','payment_voucher_id'];


	public function paymentVoucher(){return $this->belongsTo(PaymentVoucher::class, 'payment_voucher_id', 'id');}
}

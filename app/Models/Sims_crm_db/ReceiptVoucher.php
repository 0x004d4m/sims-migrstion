<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptVoucher extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'receipt_voucher';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','subject','cash_amount','date_of_receipt','number','description','contact_id','sales_order_id','total_amount','currency_id','organization_id','payment_method_id','invoice_id'];


	public function paymentMethod(){return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');}

	public function invoice(){return $this->belongsTo(Invoice::class, 'invoice_id', 'id');}

	public function contact(){return $this->belongsTo(Contact::class, 'contact_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function organization(){return $this->belongsTo(Organization::class, 'organization_id', 'id');}
}

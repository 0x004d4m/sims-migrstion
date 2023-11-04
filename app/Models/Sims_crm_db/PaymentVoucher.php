<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVoucher extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'payment_voucher';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','total_amount','cash_amount','payment_date','subject','description','number','supplier_organization_id','supplier_invoice_id','currency_id','payment_method_id','supplier_contact_id'];


	public function paymentMethod(){return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');}

	public function supplierInvoice(){return $this->belongsTo(SupplierInvoice::class, 'supplier_invoice_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function supplierOrganization(){return $this->belongsTo(SupplierOrganization::class, 'supplier_organization_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContact::class, 'supplier_contact_id', 'id');}
}

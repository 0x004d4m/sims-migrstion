<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierInvoice extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'supplier_invoice';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','due_date','sales_tax_percentage','invoice_date','total_amount','description','subject','invoice_number','supplier_organization_id','purchase_order_id','currency_id','supplier_contact_id','subtotal_amount','supplier_invoice_status_option_id','comperDays'];


	public function supplierContact(){return $this->belongsTo(SupplierContact::class, 'supplier_contact_id', 'id');}

	public function purchaseOrder(){return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id', 'id');}

	public function supplierOrganization(){return $this->belongsTo(SupplierOrganization::class, 'supplier_organization_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function supplierInvoiceStatusOption(){return $this->belongsTo(ListOption::class, 'supplier_invoice_status_option_id', 'id');}
}

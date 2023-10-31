<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderInvoices extends Model
{
	use HasFactory;
	protected $table = 'purchase_order_invoices';

	protected $connection = 'sims_new';

	protected $fillable = ['id','purchase_order_id','location_id','supplier_organisation_id','supplier_contact_id','purchase_order_invoice_status_id','assigned_user_id','currency_id','date','subject','due_date','subtotal_amount','sales_tax_percentage','total_amount','description','created_at','updated_at','number','tenant_id','u_id','tax_amount'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function purchaseOrder(){return $this->belongsTo(PurchaseOrders::class, 'purchase_order_id', 'id');}

	public function purchaseOrderInvoiceStatus(){return $this->belongsTo(PurchaseOrderStatuses::class, 'purchase_order_invoice_status_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContacts::class, 'supplier_contact_id', 'id');}

	public function supplierOrganisation(){return $this->belongsTo(SupplierOrganisations::class, 'supplier_organisation_id', 'id');}
}

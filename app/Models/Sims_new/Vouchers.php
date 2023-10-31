<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
	use HasFactory;
	protected $table = 'vouchers';

	protected $connection = 'sims_new';

	protected $fillable = ['id','type','location_id','sales_order_invoices_id','purchase_order_invoices_id','assigned_user_id','organisation_id','contact_id','supplier_organisation_id','supplier_contact_id','currency_id','payment_method_id','subject','number','date_of_receipt','description','cash_amount','total_amount','created_at','updated_at','tenant_id','u_id'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function contact(){return $this->belongsTo(Contacts::class, 'contact_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function organisation(){return $this->belongsTo(Organisations::class, 'organisation_id', 'id');}

	public function paymentMethod(){return $this->belongsTo(PaymentMethods::class, 'payment_method_id', 'id');}

	public function purchaseOrderInvoice(){return $this->belongsTo(PurchaseOrderInvoices::class, 'purchase_order_invoices_id', 'id');}

	public function salesOrderInvoice(){return $this->belongsTo(SalesOrderInvoices::class, 'sales_order_invoices_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContacts::class, 'supplier_contact_id', 'id');}

	public function supplierOrganisation(){return $this->belongsTo(SupplierOrganisations::class, 'supplier_organisation_id', 'id');}
}

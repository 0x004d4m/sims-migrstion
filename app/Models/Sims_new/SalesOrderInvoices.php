<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderInvoices extends Model
{
	use HasFactory;
	protected $table = 'sales_order_invoices';

	protected $connection = 'sims_new';

	protected $fillable = ['id','sales_order_id','location_id','organisation_id','sales_order_invoice_status_id','assigned_user_id','currency_id','date','subject','due_date','subtotal_amount','sales_tax_percentage','total_amount','description','created_at','updated_at','contact_id','supplier_organisation_id','supplier_contact_id','number','tenant_id','u_id','tax_amount'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function contact(){return $this->belongsTo(Contacts::class, 'contact_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function organisation(){return $this->belongsTo(Organisations::class, 'organisation_id', 'id');}

	public function salesOrder(){return $this->belongsTo(SalesOrders::class, 'sales_order_id', 'id');}

	public function salesOrderInvoiceStatus(){return $this->belongsTo(SalesOrderInvoiceStatuses::class, 'sales_order_invoice_status_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContacts::class, 'supplier_contact_id', 'id');}

	public function supplierOrganisation(){return $this->belongsTo(SupplierOrganisations::class, 'supplier_organisation_id', 'id');}
}

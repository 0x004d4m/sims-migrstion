<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrders extends Model
{
	use HasFactory;
	protected $table = 'purchase_orders';

	protected $connection = 'sims_new';

	protected $fillable = ['id','location_id','purchase_order_status_id','assigned_user_id','currency_id','supplier_contact_id','supplier_organisation_id','subject','number','due_date','subtotal_amount','sales_tax_percentage','total_amount','tax_amount','description','tenant_id','u_id','created_at','updated_at','request_for_quotation_id'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function purchaseOrderStatus(){return $this->belongsTo(PurchaseOrderStatuses::class, 'purchase_order_status_id', 'id');}

	public function requestForQuotation(){return $this->belongsTo(RequestForQuotations::class, 'request_for_quotation_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContacts::class, 'supplier_contact_id', 'id');}

	public function supplierOrganisation(){return $this->belongsTo(SupplierOrganisations::class, 'supplier_organisation_id', 'id');}
}

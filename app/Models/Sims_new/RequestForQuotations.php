<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForQuotations extends Model
{
	use HasFactory;
	protected $table = 'request_for_quotations';

	protected $connection = 'sims_new';

	protected $fillable = ['id','location_id','purchase_order_id','assigned_user_id','supplier_contact_id','supplier_organisation_id','request_for_quotation_stage_id','title','number','request_date','email_token','filled_by_supplier','filled_at','description','tenant_id','tax_amount','u_id','created_at','updated_at','supplier_category_id','slug'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function purchaseOrder(){return $this->belongsTo(PurchaseOrders::class, 'purchase_order_id', 'id');}

	public function requestForQuotationStage(){return $this->belongsTo(RequestForQuotationStages::class, 'request_for_quotation_stage_id', 'id');}

	public function supplierCategory(){return $this->belongsTo(SupplierCategories::class, 'supplier_category_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContacts::class, 'supplier_contact_id', 'id');}

	public function supplierOrganisation(){return $this->belongsTo(SupplierOrganisations::class, 'supplier_organisation_id', 'id');}
}

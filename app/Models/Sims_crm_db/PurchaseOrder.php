<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'purchase_order';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','subject','due_date','number','description','contact_id','currency_id','organization_id','supplier_organization_id','supplier_contact_id','request_for_quotation_id','sales_tax_percentage','subtotal_amount','total_amount','purchase_order_status_option_id'];


	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function supplierOrganization(){return $this->belongsTo(SupplierOrganization::class, 'supplier_organization_id', 'id');}

	public function requestForQuotation(){return $this->belongsTo(RequestForQuotation::class, 'request_for_quotation_id', 'id');}

	public function contact(){return $this->belongsTo(Contact::class, 'contact_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContact::class, 'supplier_contact_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function organization(){return $this->belongsTo(Organization::class, 'organization_id', 'id');}

	public function purchaseOrderStatusOption(){return $this->belongsTo(ListOption::class, 'purchase_order_status_option_id', 'id');}
}

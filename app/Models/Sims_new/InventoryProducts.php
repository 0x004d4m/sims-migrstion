<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryProducts extends Model
{
	use HasFactory;
	protected $table = 'inventory_products';

	protected $connection = 'sims_new';

	protected $fillable = ['id','location_id','inventory_product_category_id','usage_unit_id','assigned_user_id','currency_id','number','manufacturer','active','expiry_date','unit_price','name','supplier_part_number','manufacturer_part_number','website','quantity_in_stock','purchase_cost','description','tenant_id','u_id','tax_rate','created_at','updated_at','supplier_organisation_id','supplier_contact_id'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function inventoryProductCategory(){return $this->belongsTo(InventoryProductCategories::class, 'inventory_product_category_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContacts::class, 'supplier_contact_id', 'id');}

	public function supplierOrganisation(){return $this->belongsTo(SupplierOrganisations::class, 'supplier_organisation_id', 'id');}

	public function usageUnit(){return $this->belongsTo(UsageUnits::class, 'usage_unit_id', 'id');}
}

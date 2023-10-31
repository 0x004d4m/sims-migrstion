<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','website','supplier_part_number','manufacturer','quantity_in_stock','manufacturer_part_number','name','is_active','description','serial_number','supplier_organization_id','unit_price','purchase_cost','currency_id','number','supplier_contact_id','product_category_option_id','expiry_date','usage_unit_option_id'];


	public function supplierContact(){return $this->belongsTo(SupplierContact::class, 'supplier_contact_id', 'id');}

	public function supplierOrganization(){return $this->belongsTo(SupplierOrganization::class, 'supplier_organization_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function productCategoryOption(){return $this->belongsTo(ListOption::class, 'product_category_option_id', 'id');}

	public function usageUnitOption(){return $this->belongsTo(ListOption::class, 'usage_unit_option_id', 'id');}
}

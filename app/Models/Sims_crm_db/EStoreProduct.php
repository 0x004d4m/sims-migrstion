<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['description','list_price','maximum_order_quantity','minimum_order_quantity','name','number','price','quantity_in_stock','quantity_step','thumbnail_image_file_name','id','currency_id','e_store_item_status_id','e_store_product_selling_unit_option_id','e_store_division_id'];


	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function eStoreDivision(){return $this->belongsTo(EStoreDivision::class, 'e_store_division_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function eStoreItemStatus(){return $this->belongsTo(EStoreItemStatus::class, 'e_store_item_status_id', 'id');}

	public function eStoreProductSellingUnitOption(){return $this->belongsTo(ListOption::class, 'e_store_product_selling_unit_option_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['description','height','length','list_price','manufacturer_part_number','maximum_order_quantity','meta_description','meta_keywords','minimum_order_quantity','model_number','name','number','price','quantity_in_stock','quantity_step','sort_order','thumbnail_image_file_name','weight','width','id','currency_id','electronics_store_item_status_id','electronics_store_length_class_id','electronics_store_manufacturer_id','electronics_store_product_stock_status_id','electronics_store_weight_class_id'];


	public function electronicsStoreLengthClass(){return $this->belongsTo(ElectronicsStoreLengthClass::class, 'electronics_store_length_class_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function electronicsStoreItemStatus(){return $this->belongsTo(ElectronicsStoreItemStatus::class, 'electronics_store_item_status_id', 'id');}

	public function electronicsStoreManufacturer(){return $this->belongsTo(ElectronicsStoreManufacturer::class, 'electronics_store_manufacturer_id', 'id');}

	public function electronicsStoreProductStockStatus(){return $this->belongsTo(ElectronicsStoreProductStockStatus::class, 'electronics_store_product_stock_status_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function electronicsStoreWeightClass(){return $this->belongsTo(ElectronicsStoreWeightClass::class, 'electronics_store_weight_class_id', 'id');}
}

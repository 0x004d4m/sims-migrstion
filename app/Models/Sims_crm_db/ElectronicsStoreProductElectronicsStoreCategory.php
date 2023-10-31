<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreProductElectronicsStoreCategory extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_product_electronics_store_category';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['electronics_store_product_id','electronics_store_category_id'];


	public function electronicsStoreProduct(){return $this->belongsTo(ElectronicsStoreProduct::class, 'electronics_store_product_id', 'id');}

	public function electronicsStoreCategory(){return $this->belongsTo(ElectronicsStoreCategory::class, 'electronics_store_category_id', 'id');}
}

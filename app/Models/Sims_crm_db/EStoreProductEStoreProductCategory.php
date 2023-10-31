<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreProductEStoreProductCategory extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_product_e_store_product_category';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['e_store_product_id','e_store_product_category_id'];


	public function eStoreProduct(){return $this->belongsTo(EStoreProduct::class, 'e_store_product_id', 'id');}

	public function eStoreProductCategory(){return $this->belongsTo(EStoreProductCategory::class, 'e_store_product_category_id', 'id');}
}

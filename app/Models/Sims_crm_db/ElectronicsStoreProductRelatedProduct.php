<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreProductRelatedProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_product_related_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['electronics_store_product_id','electronics_store_related_product_id'];


	public function electronicsStoreRelatedProduct(){return $this->belongsTo(ElectronicsStoreProduct::class, 'electronics_store_related_product_id', 'id');}

	public function electronicsStoreProduct(){return $this->belongsTo(ElectronicsStoreProduct::class, 'electronics_store_product_id', 'id');}
}

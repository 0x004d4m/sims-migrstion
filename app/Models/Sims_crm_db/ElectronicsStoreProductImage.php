<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreProductImage extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_product_image';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['electronics_store_product_id','image_file_name'];


	public function electronicsStoreProduct(){return $this->belongsTo(ElectronicsStoreProduct::class, 'electronics_store_product_id', 'id');}
}

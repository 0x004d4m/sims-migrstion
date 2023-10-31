<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreProductImage extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_product_image';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['e_store_product_id','image_file_name'];


	public function eStoreProduct(){return $this->belongsTo(EStoreProduct::class, 'e_store_product_id', 'id');}
}

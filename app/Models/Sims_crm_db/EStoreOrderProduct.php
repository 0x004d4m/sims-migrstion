<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreOrderProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_order_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','e_store_product_id','e_store_order_id'];


	public function eStoreOrder(){return $this->belongsTo(EStoreOrder::class, 'e_store_order_id', 'id');}

	public function eStoreProduct(){return $this->belongsTo(EStoreProduct::class, 'e_store_product_id', 'id');}
}

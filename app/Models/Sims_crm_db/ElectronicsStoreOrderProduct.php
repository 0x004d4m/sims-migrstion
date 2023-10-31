<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreOrderProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_order_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','currency_id','electronics_store_product_id','electronics_store_order_id'];


	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function electronicsStoreProduct(){return $this->belongsTo(ElectronicsStoreProduct::class, 'electronics_store_product_id', 'id');}

	public function electronicsStoreOrder(){return $this->belongsTo(ElectronicsStoreOrder::class, 'electronics_store_order_id', 'id');}
}

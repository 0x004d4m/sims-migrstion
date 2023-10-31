<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreProductSpecialOffer extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_product_special_offer';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','end_date','price','priority','start_date','currency_id','electronics_store_product_id'];


	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function electronicsStoreProduct(){return $this->belongsTo(ElectronicsStoreProduct::class, 'electronics_store_product_id', 'id');}
}

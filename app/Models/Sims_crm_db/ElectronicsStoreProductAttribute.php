<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreProductAttribute extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_product_attribute';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','text','electronics_store_atribute_id','electronics_store_product_id'];


	public function electronicsStoreAtribute(){return $this->belongsTo(ElectronicsStoreAttribute::class, 'electronics_store_atribute_id', 'id');}

	public function electronicsStoreProduct(){return $this->belongsTo(ElectronicsStoreProduct::class, 'electronics_store_product_id', 'id');}
}

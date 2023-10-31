<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreManufacturer extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_manufacturer';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','image_file_name','name','sort_order','electronics_store_item_status_id'];


	public function electronicsStoreItemStatus(){return $this->belongsTo(ElectronicsStoreItemStatus::class, 'electronics_store_item_status_id', 'id');}
}

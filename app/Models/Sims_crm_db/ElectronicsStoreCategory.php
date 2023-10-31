<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreCategory extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_category';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','name','sort_order','thumbnail_image_file_name','electronics_store_item_status_id','parent_category_id','meta_description','meta_keywords'];


	public function parentCategory(){return $this->belongsTo(ElectronicsStoreCategory::class, 'parent_category_id', 'id');}

	public function electronicsStoreItemStatus(){return $this->belongsTo(ElectronicsStoreItemStatus::class, 'electronics_store_item_status_id', 'id');}
}

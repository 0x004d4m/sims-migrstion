<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreProductCategory extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_product_category';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','name','thumbnail_image_file_name','e_store_item_status_id','parent_category_id','e_store_division_id'];


	public function parentCategory(){return $this->belongsTo(EStoreProductCategory::class, 'parent_category_id', 'id');}

	public function eStoreDivision(){return $this->belongsTo(EStoreDivision::class, 'e_store_division_id', 'id');}

	public function eStoreItemStatus(){return $this->belongsTo(EStoreItemStatus::class, 'e_store_item_status_id', 'id');}
}

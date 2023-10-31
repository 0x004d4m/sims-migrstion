<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreProductReview extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_product_review';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','author_name','comment','rating','review_time','electronics_store_product_id','electronics_store_product_review_status_id'];


	public function electronicsStoreProduct(){return $this->belongsTo(ElectronicsStoreProduct::class, 'electronics_store_product_id', 'id');}

	public function electronicsStoreProductReviewStatus(){return $this->belongsTo(ElectronicsStoreProductReviewStatus::class, 'electronics_store_product_review_status_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'purchase_order_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','purchase_order_id','product_id','description'];


	public function purchaseOrder(){return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id', 'id');}

	public function product(){return $this->belongsTo(Product::class, 'product_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderCustomItem extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'purchase_order_custom_item';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','description','name','purchase_order_id'];


	public function purchaseOrder(){return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id', 'id');}
}

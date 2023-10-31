<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderCustomItem extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'sales_order_custom_item';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','name','description','sales_order_id'];


	public function salesOrder(){return $this->belongsTo(SalesOrder::class, 'sales_order_id', 'id');}
}

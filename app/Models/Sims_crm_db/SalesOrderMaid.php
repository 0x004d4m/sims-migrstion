<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderMaid extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'sales_order_maid';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','price','maid_id','sales_order_id'];


	public function maid(){return $this->belongsTo(Maid::class, 'maid_id', 'id');}

	public function salesOrder(){return $this->belongsTo(SalesOrder::class, 'sales_order_id', 'id');}
}

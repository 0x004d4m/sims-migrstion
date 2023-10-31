<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderService extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'sales_order_service';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','sales_order_id','service_id','description'];


	public function service(){return $this->belongsTo(Service::class, 'service_id', 'id');}

	public function salesOrder(){return $this->belongsTo(SalesOrder::class, 'sales_order_id', 'id');}
}

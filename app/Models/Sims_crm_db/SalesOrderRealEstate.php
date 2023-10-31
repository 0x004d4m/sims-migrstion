<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderRealEstate extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'sales_order_real_estate';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','price','sales_order_id','real_estate_id'];


	public function realEstate(){return $this->belongsTo(RealEstate::class, 'real_estate_id', 'id');}

	public function salesOrder(){return $this->belongsTo(SalesOrder::class, 'sales_order_id', 'id');}
}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderInvoiceStatuses extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'sales_order_invoice_statuses';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tenant_id','name','u_id'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

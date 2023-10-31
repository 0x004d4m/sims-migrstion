<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderInvoiceStatuses extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'purchase_order_invoice_statuses';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','tenant_id','u_id'];

}

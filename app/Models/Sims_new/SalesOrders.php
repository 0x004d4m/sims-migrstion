<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrders extends Model
{
	use HasFactory;
	protected $table = 'sales_orders';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tenant_id','location_id','quote_id','sales_order_status_id','assigned_user_id','currency_id','opportunity_id','organisation_id','subject','due_date','subtotal_amount','sales_tax_percentage','total_amount','tax_amount','description','created_at','updated_at','contact_id','u_id'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function contact(){return $this->belongsTo(Contacts::class, 'contact_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function opportunity(){return $this->belongsTo(Opportunities::class, 'opportunity_id', 'id');}

	public function organisation(){return $this->belongsTo(Organisations::class, 'organisation_id', 'id');}

	public function quote(){return $this->belongsTo(Quotes::class, 'quote_id', 'id');}

	public function salesOrderStatus(){return $this->belongsTo(SalesOrderStatuses::class, 'sales_order_status_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

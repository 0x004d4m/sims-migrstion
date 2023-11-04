<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'sales_order';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','subject','due_date','description','currency_id','quote_id','organization_id','contact_id','opportunity_id','sales_tax_percentage','subtotal_amount','total_amount','sales_order_status_option_id','media_tax_percentage'];


	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function opportunity(){return $this->belongsTo(Opportunity::class, 'opportunity_id', 'id');}

	public function quote(){return $this->belongsTo(Quote::class, 'quote_id', 'id');}

	public function contact(){return $this->belongsTo(Contact::class, 'contact_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function organization(){return $this->belongsTo(Organization::class, 'organization_id', 'id');}

	public function salesOrderStatusOption(){return $this->belongsTo(ListOption::class, 'sales_order_status_option_id', 'id');}
}

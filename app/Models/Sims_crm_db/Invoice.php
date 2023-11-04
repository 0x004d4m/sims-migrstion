<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'invoice';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','subject','due_date','invoice_date','number','description','sales_order_id','total_amount','sales_tax_percentage','currency_id','contact_id','organization_id','subtotal_amount','invoice_status_option_id','comperDays','media_tax_percentage'];


	public function organization(){return $this->belongsTo(Organization::class, 'organization_id', 'id');}

	public function contact(){return $this->belongsTo(Contact::class, 'contact_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function salesOrder(){return $this->belongsTo(SalesOrder::class, 'sales_order_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function invoiceStatusOption(){return $this->belongsTo(ListOption::class, 'invoice_status_option_id', 'id');}
}

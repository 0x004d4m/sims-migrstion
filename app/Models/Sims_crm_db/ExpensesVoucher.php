<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesVoucher extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'expenses_voucher';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['is_cash_expenses','description','invoice_date','invoice_number','number','sales_tax_percentage','subject','subtotal_amount','total_amount','verified','id','category','currency_id','expenses_contact_id','supplier_invoice_status_option_id','expenses_organization_id'];


	public function ListOption(){return $this->hasOne(ListOption::class, 'category', 'id');}

	public function expensesContact(){return $this->belongsTo(ExpensesContact::class, 'expenses_contact_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function expensesOrganization(){return $this->belongsTo(ExpensesContact::class, 'expenses_organization_id', 'id');}

	public function supplierInvoiceStatusOption(){return $this->belongsTo(ListOption::class, 'supplier_invoice_status_option_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}
}

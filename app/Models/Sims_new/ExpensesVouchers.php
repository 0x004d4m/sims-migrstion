<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesVouchers extends Model
{
	use HasFactory;
	protected $table = 'expenses_vouchers';

	protected $connection = 'sims_new';

	protected $fillable = ['id','location_id','supplier_invoice_status_id','assigned_user_id','currency_id','expenses_contact_id','expenses_organisation_id','subject','number','cash_expenses','date','subtotal_amount','sales_tax_percentage','total_amount','description','created_at','updated_at','u_id','organization_name','tax_amount','tenant_id','type'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function expensesContact(){return $this->belongsTo(ExpensesAccounts::class, 'expenses_contact_id', 'id');}

	public function expensesOrganisation(){return $this->belongsTo(ExpensesAccounts::class, 'expenses_organisation_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function supplierInvoiceStatus(){return $this->belongsTo(PurchaseOrderInvoiceStatuses::class, 'supplier_invoice_status_id', 'id');}
}

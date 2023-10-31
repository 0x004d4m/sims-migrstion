<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesVoucherCustomItem extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'expenses_voucher_custom_item';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','name','quantity','unit_price','expenses_voucher_id'];


	public function expensesVoucher(){return $this->belongsTo(ExpensesVoucher::class, 'expenses_voucher_id', 'id');}
}

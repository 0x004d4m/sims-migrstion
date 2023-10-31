<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesVoucherProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'expenses_voucher_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','quantity','unit_price','expenses_voucher_id','product_id'];


	public function expensesVoucher(){return $this->belongsTo(ExpensesVoucher::class, 'expenses_voucher_id', 'id');}

	public function product(){return $this->belongsTo(Product::class, 'product_id', 'id');}
}

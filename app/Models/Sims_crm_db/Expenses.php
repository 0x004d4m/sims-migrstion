<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'expenses';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['beneficiary_name','cash_amount','date','description','payment_voucher_number','total_amount','verified','id','category','currency_id','payment_method_id'];


	public function paymentMethod(){return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function ListOption(){return $this->hasOne(ListOption::class, 'category', 'id');}
}

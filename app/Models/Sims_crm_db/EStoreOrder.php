<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreOrder extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_order';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['number','subtotal_amount','total_amount','id','currency_id','e_store_order_payment_method_option_id','e_store_order_status_option_id','e_store_user_id','address','latitude','longitude','e_store_division_id'];


	public function eStoreUser(){return $this->belongsTo(EStoreUser::class, 'e_store_user_id', 'id');}

	public function eStoreOrderStatusOption(){return $this->belongsTo(ListOption::class, 'e_store_order_status_option_id', 'id');}

	public function eStoreOrderPaymentMethodOption(){return $this->belongsTo(ListOption::class, 'e_store_order_payment_method_option_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function eStoreDivision(){return $this->belongsTo(EStoreDivision::class, 'e_store_division_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}
}

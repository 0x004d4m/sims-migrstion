<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreOrder extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_order';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['address','latitude','longitude','number','sales_tax_percentage','subtotal_amount','total_amount','id','currency_id','electronics_store_order_status_id','electronics_store_payment_method_id','electronics_store_user_id'];


	public function electronicsStoreUser(){return $this->belongsTo(ElectronicsStoreUser::class, 'electronics_store_user_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function electronicsStoreOrderStatus(){return $this->belongsTo(ElectronicsStoreOrderStatus::class, 'electronics_store_order_status_id', 'id');}

	public function electronicsStorePaymentMethod(){return $this->belongsTo(ElectronicsStorePaymentMethod::class, 'electronics_store_payment_method_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}
}

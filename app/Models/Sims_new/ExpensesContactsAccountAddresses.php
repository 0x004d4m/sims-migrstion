<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesContactsAccountAddresses extends Model
{
	use HasFactory;
	protected $table = 'expenses_contacts_account_addresses';

	protected $connection = 'sims_new';

	protected $fillable = ['id','billing_country_id','billing_state','billing_postal_code','billing_address','billing_city','billing_p_o_box','shipping_country_id','shipping_state','shipping_postal_code','shipping_address','shipping_city','shipping_p_o_box','contact_account_id','created_at','updated_at'];


	public function billingCountry(){return $this->belongsTo(Countries::class, 'billing_country_id', 'id');}

	public function contactAccount(){return $this->belongsTo(ExpensesContactsAccounts::class, 'contact_account_id', 'id');}

	public function shippingCountry(){return $this->belongsTo(Countries::class, 'shipping_country_id', 'id');}
}

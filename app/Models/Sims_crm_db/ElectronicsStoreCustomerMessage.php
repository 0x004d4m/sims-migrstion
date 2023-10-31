<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreCustomerMessage extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_customer_message';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','email','first_name','inquiry','last_name','is_read','send_time'];

}

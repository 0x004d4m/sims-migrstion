<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountings extends Model
{
	use HasFactory;
	protected $table = 'accountings';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tenant_id','location_id','voucher_id','object_type','object_id','customer_invoice_id','balance','u_id','created_at','updated_at'];

}

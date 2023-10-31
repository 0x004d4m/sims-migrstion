<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingPayables extends Model
{
	use HasFactory;
	protected $table = 'accounting_payables';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tenant_id','location_id','object_type','object_id','balance','u_id','created_at','updated_at'];

}

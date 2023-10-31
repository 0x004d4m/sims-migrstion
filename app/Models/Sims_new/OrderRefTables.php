<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRefTables extends Model
{
	use HasFactory;
	protected $table = 'order_ref_tables';

	protected $connection = 'sims_new';

	protected $fillable = ['id','ci','si','rv','pv','created_at','updated_at','tenant_id','u_id','sq','rfq','po'];

}

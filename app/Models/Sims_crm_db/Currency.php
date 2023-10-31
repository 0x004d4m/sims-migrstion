<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'currency';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','display_name','currency_code','decimal_places'];

}

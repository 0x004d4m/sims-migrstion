<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckPayments extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'check_payments';

	protected $connection = 'sims_new';

	protected $fillable = ['id','object_type','object_id','check_number','check_account_name','bank_name','check_amount','check_due_date'];

}

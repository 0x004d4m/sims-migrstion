<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'payment_methods';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name'];

}

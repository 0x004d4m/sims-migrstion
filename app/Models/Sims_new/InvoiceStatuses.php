<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceStatuses extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'invoice_statuses';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name'];

}

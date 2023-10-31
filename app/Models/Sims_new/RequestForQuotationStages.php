<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForQuotationStages extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'request_for_quotation_stages';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','u_id','tenant_id'];

}

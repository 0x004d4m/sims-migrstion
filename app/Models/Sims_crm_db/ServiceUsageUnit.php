<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceUsageUnit extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'service_usage_unit';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','name'];

}

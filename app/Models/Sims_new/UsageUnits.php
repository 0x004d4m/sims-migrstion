<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageUnits extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'usage_units';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','u_id','tenant_id'];

}

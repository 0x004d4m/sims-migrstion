<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'job_title';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','name'];

}

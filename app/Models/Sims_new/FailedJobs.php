<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedJobs extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'failed_jobs';

	protected $connection = 'sims_new';

	protected $fillable = ['id','uuid','connection','queue','payload','exception','failed_at'];

}

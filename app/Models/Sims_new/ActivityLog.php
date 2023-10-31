<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
	use HasFactory;
	protected $table = 'activity_log';

	protected $connection = 'sims_new';

	protected $fillable = ['id','log_name','description','subject_type','event','subject_id','causer_type','causer_id','properties','batch_uuid','created_at','updated_at'];

}

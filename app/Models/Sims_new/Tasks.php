<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
	use HasFactory;
	protected $table = 'tasks';

	protected $connection = 'sims_new';

	protected $fillable = ['id','subject','description','priority','status_id','start_time','end_time','object_type','object_id','creator_id','created_at','updated_at','assigned_user_id','notes','u_id','tenant_id','location_id','task_priority_id','related_document'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}

	public function status(){return $this->belongsTo(TaskStatuses::class, 'status_id', 'id');}
}

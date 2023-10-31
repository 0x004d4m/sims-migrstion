<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'project_task';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','subject','target_finish_date','actual_finish_date','start_date','description','project_id','project_task_priority_option_id','project_task_status_option_id'];


	public function project(){return $this->belongsTo(Project::class, 'project_id', 'id');}

	public function projectTaskPriorityOption(){return $this->belongsTo(ListOption::class, 'project_task_priority_option_id', 'id');}

	public function projectTaskStatusOption(){return $this->belongsTo(ListOption::class, 'project_task_status_option_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}
}

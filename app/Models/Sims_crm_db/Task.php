<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'task';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','end_time','start_time','description','subject','document_id','related_document_form_id','task_priority_option_id','task_status_option_id'];


	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function taskPriorityOption(){return $this->belongsTo(ListOption::class, 'task_priority_option_id', 'id');}

	public function taskStatusOption(){return $this->belongsTo(ListOption::class, 'task_status_option_id', 'id');}
}

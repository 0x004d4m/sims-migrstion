<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentDoctors extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'department_doctors';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['department_id','doctors_id'];


	public function doctor(){return $this->belongsTo(User::class, 'doctors_id', 'id');}

	public function department(){return $this->belongsTo(Department::class, 'department_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'disease';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','name','department_id'];


	public function department(){return $this->belongsTo(Department::class, 'department_id', 'id');}
}

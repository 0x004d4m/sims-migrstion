<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDos extends Model
{
	use HasFactory;
	protected $table = 'to_dos';

	protected $connection = 'sims_new';

	protected $fillable = ['id','subject','description','note','date','is_completed','creator_id','assigned_user_id','created_at','updated_at','u_id','tenant_id','location_id'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}
}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitles extends Model
{
	use HasFactory;
	protected $table = 'job_titles';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','description','tenant_id','created_at','updated_at','u_id'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

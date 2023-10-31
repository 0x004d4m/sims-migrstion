<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsStatuses extends Model
{
	use HasFactory;
	protected $table = 'leads_statuses';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','created_at','updated_at'];

}

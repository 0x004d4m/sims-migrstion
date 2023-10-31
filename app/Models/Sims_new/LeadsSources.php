<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsSources extends Model
{
	use HasFactory;
	protected $table = 'leads_sources';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','created_at','updated_at'];

}

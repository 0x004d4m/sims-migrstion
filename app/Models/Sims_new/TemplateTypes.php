<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateTypes extends Model
{
	use HasFactory;
	protected $table = 'template_types';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','created_at','updated_at'];

}

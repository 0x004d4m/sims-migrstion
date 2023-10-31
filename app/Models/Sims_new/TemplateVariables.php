<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateVariables extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'template_variables';

	protected $connection = 'sims_new';

	protected $fillable = ['id','type','variable','value'];

}

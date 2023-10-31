<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'module';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','module_path','document_path','name','form_path'];

}

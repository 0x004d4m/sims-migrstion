<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'setting';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','design_name','display_name'];

}

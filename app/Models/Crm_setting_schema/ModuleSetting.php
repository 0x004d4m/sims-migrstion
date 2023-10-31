<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleSetting extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'module_setting';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id'];


	public function Settings(){return $this->hasMany(Setting::class, 'id', 'id');}
}

<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionsListSetting extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'options_list_setting';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id'];


	public function Setting(){return $this->hasOne(Setting::class, 'id', 'id');}
}

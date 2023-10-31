<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListOption extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'list_option';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','options_list_setting_id'];


	public function optionsListSetting(){return $this->belongsTo(\App\Models\Crm_setting_schema\OptionsListSetting::class, 'options_list_setting_id', 'id');}
}

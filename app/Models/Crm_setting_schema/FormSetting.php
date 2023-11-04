<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSetting extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'form_setting';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['class_name','layout_path','id','module_id','default_view_id','before_save_script','category_name'];


	public function module(){return $this->belongsTo(ModuleSetting::class, 'module_id', 'id');}

	public function defaultView(){return $this->belongsTo(ViewSetting::class, 'default_view_id', 'id');}

	public function Setting(){return $this->hasOne(Setting::class, 'id', 'id');}
}

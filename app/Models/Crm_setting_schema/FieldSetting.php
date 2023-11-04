<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldSetting extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'field_setting';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['field_type','list_option_class_name','is_required','variable_name','id','lookup_form_id','options_list_setting_id','form_id','subform_id','lookup_script','computed_field_script','script_to_execute_on_value_change','components_to_update_on_value_change','hide_when_script'];


	public function optionsListSetting(){return $this->belongsTo(OptionsListSetting::class, 'options_list_setting_id', 'id');}

	public function form(){return $this->belongsTo(FormSetting::class, 'form_id', 'id');}

	public function subform(){return $this->belongsTo(SubformSetting::class, 'subform_id', 'id');}

	public function lookupForm(){return $this->belongsTo(FormSetting::class, 'lookup_form_id', 'id');}

	public function Setting(){return $this->hasOne(Setting::class, 'id', 'id');}
}

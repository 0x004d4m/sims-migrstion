<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubformSetting extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'subform_setting';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['class_name','id','form_id','variable_name','hide_when_script','parent_subform_id'];


	public function form(){return $this->belongsTo(FormSetting::class, 'form_id', 'id');}

	public function Settings(){return $this->hasMany(Setting::class, 'id', 'id');}

	public function parentSubform(){return $this->belongsTo(SubformSetting::class, 'parent_subform_id', 'id');}
}

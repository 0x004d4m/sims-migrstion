<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewSetting extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'view_setting';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','form_id','view_conditions_script','subform_id'];


	public function Settings(){return $this->hasMany(Setting::class, 'id', 'id');}

	public function form(){return $this->belongsTo(FormSetting::class, 'form_id', 'id');}

	public function subform(){return $this->belongsTo(SubformSetting::class, 'subform_id', 'id');}
}

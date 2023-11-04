<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DialogSetting extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'dialog_setting';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['on_open_script','id','parent_form_id','target_form_id','disable_when_script'];


	public function targetForm(){return $this->belongsTo(FormSetting::class, 'target_form_id', 'id');}

	public function Setting(){return $this->hasOne(Setting::class, 'id', 'id');}

	public function parentForm(){return $this->belongsTo(FormSetting::class, 'parent_form_id', 'id');}
}

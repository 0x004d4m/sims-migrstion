<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewTargetFormField extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'view_target_form_field';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['view_id','target_form_field_id'];


	public function view(){return $this->belongsTo(ViewSetting::class, 'view_id', 'id');}

	public function targetFormField(){return $this->belongsTo(FieldSetting::class, 'target_form_field_id', 'id');}
}

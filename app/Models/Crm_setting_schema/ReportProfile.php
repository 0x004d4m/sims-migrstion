<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProfile extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'report_profile';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','sort_order','title','default_sort_field_id','key_field_id','target_form_id'];


	public function keyField(){return $this->belongsTo(FieldSetting::class, 'key_field_id', 'id');}

	public function targetForm(){return $this->belongsTo(FormSetting::class, 'target_form_id', 'id');}

	public function defaultSortField(){return $this->belongsTo(FieldSetting::class, 'default_sort_field_id', 'id');}
}

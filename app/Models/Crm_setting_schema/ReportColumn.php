<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportColumn extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'report_column';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','column_label','fetch_operation','fetch_condition_id','fetch_field_id','parent_report_profile_id'];


	public function parentReportProfile(){return $this->belongsTo(ReportProfile::class, 'parent_report_profile_id', 'id');}

	public function fetchCondition(){return $this->belongsTo(FetchCondition::class, 'fetch_condition_id', 'id');}

	public function fetchField(){return $this->belongsTo(FieldSetting::class, 'fetch_field_id', 'id');}
}

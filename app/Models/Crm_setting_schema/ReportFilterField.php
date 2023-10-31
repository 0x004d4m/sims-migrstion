<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportFilterField extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'report_filter_field';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['report_id','field_id'];


	public function field(){return $this->belongsTo(FieldSetting::class, 'field_id', 'id');}

	public function report(){return $this->belongsTo(ReportProfile::class, 'report_id', 'id');}
}

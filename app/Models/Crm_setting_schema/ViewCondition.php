<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewCondition extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'view_condition';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','condition_type','field_value','field_id','view_id'];


	public function field(){return $this->belongsTo(FieldSetting::class, 'field_id', 'id');}

	public function view(){return $this->belongsTo(ViewSetting::class, 'view_id', 'id');}
}

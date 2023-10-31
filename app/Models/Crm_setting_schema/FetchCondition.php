<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FetchCondition extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'fetch_condition';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','condition_role','condition_type','string_value','field_id','parent_conjuction_group_id','parent_disjunction_group_id'];


	public function parentConjuctionGroup(){return $this->belongsTo(FetchCondition::class, 'parent_conjuction_group_id', 'id');}

	public function field(){return $this->belongsTo(FieldSetting::class, 'field_id', 'id');}

	public function parentDisjunctionGroup(){return $this->belongsTo(FetchCondition::class, 'parent_disjunction_group_id', 'id');}
}

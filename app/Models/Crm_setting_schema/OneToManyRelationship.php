<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneToManyRelationship extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'one_to_many_relationship';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','many_form_id','many_form_relationship_field_id','one_form_id'];


	public function oneForm(){return $this->belongsTo(FormSetting::class, 'one_form_id', 'id');}

	public function manyFormRelationshipField(){return $this->belongsTo(FieldSetting::class, 'many_form_relationship_field_id', 'id');}

	public function manyForm(){return $this->belongsTo(FormSetting::class, 'many_form_id', 'id');}
}

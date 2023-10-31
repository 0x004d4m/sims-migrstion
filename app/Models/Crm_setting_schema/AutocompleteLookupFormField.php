<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutocompleteLookupFormField extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'autocomplete_lookup_form_field';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['autocomplete_field_id','lookup_form_field_id'];


	public function autocompleteField(){return $this->belongsTo(FieldSetting::class, 'autocomplete_field_id', 'id');}

	public function lookupFormField(){return $this->belongsTo(FieldSetting::class, 'lookup_form_field_id', 'id');}
}

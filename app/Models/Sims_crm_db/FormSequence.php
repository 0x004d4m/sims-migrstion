<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSequence extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'form_sequence';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','last_number_value','form_id'];


	public function form(){return $this->belongsTo(\App\Models\Crm_setting_schema\FormSetting::class, 'form_id', 'id');}
}

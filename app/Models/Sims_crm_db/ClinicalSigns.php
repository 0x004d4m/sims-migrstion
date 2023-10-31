<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalSigns extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'clinical_signs';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','bp_option','hr_option','rr_option','spo2_option','lactating_option','pregnant_option','temprature'];

}

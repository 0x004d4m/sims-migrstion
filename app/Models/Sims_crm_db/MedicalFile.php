<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalFile extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'medical_file';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['date','description','sequence_id','subform_id','id','case_status_id','patient_id','referred_to_option_id','patient_status_option_id','referred_to_dept'];


	public function Department(){return $this->hasOne(Department::class, 'referred_to_dept', 'id');}

	public function patient(){return $this->belongsTo(Patient::class, 'patient_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function caseStatus(){return $this->belongsTo(ListOption::class, 'case_status_id', 'id');}

	public function patientStatusOption(){return $this->belongsTo(ListOption::class, 'patient_status_option_id', 'id');}

	public function referredToOption(){return $this->belongsTo(ListOption::class, 'referred_to_option_id', 'id');}
}

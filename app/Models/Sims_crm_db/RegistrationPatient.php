<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationPatient extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'registration_patient';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['sequence_id','id','case_status_id','patient_id','chief_complaint_id','clinical_signs_id'];


	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function chiefComplaint(){return $this->belongsTo(ChiefComplaint::class, 'chief_complaint_id', 'id');}

	public function caseStatus(){return $this->belongsTo(ListOption::class, 'case_status_id', 'id');}

	public function clinicalSign(){return $this->belongsTo(ClinicalSigns::class, 'clinical_signs_id', 'id');}

	public function patient(){return $this->belongsTo(Patient::class, 'patient_id', 'id');}
}

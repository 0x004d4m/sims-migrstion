<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosisPatient extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'diagnosis_patient';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','diagnosis_description','diagnosis_option_id','medical_file_id','department','disease'];


	public function diagnosisOption(){return $this->belongsTo(ListOption::class, 'diagnosis_option_id', 'id');}

	public function Department(){return $this->hasOne(Department::class, 'department', 'id');}

	public function medicalFile(){return $this->belongsTo(MedicalFile::class, 'medical_file_id', 'id');}

	public function Disease(){return $this->hasOne(Disease::class, 'disease', 'id');}
}

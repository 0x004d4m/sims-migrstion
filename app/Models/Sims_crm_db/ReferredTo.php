<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferredTo extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'referred_to';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','date','description','sequence_id','doctor_id','registration_patient_id','referred_to_id'];


	public function referredTo(){return $this->belongsTo(Department::class, 'referred_to_id', 'id');}

	public function doctor(){return $this->belongsTo(User::class, 'doctor_id', 'id');}

	public function registrationPatient(){return $this->belongsTo(RegistrationPatient::class, 'registration_patient_id', 'id');}
}

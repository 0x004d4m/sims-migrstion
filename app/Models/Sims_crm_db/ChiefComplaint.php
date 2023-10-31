<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiefComplaint extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'chief_complaint';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','is_abdominal_pain','is_abscess','is_back_pain','is_blood_stool','is_breast_pain','is_colic','is_cough','is_dental','is_diarrhea','is_dizziness','is_ear_pain','is_eye_pain','is_f_up','is_falling_down','is_fever','is_finger_pain','is_hand_pain','is_headache','is_hemorrhoids','is_joint_pain','is_kidney_pain','is_knee_pain','is_leg_pain','is_lice','is_other','is_rainy_nose','is_skin_allergy','is_skin_rach','is_through_pain','is_trauma','is_urine_problem','is_vomiting','is_warm'];

}

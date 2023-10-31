<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'patient';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['address','Age','date_pf_birth','first_name','full_name','idPatient','last_name','mobile','phone','second_name','third_name','id','gender_option_id','nationality_option_id','accept','inputQ12','inputQ13','inputQ14','inputQ6','inputQ8','inputQ9','q1','q10','q11','q12','q13','q14','q15','q16','q17','q18','q19','q2','q3','q4','q5','q6','q7','q8','q9','signature'];


	public function genderOption(){return $this->belongsTo(ListOption::class, 'gender_option_id', 'id');}

	public function nationalityOption(){return $this->belongsTo(ListOption::class, 'nationality_option_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}
}

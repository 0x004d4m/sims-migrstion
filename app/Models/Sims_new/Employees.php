<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
	use HasFactory;
	protected $table = 'employees';

	protected $connection = 'sims_new';

	protected $fillable = ['id','identity_number','first_name','middle_name','last_name','personal_email','nationality_id','salary','discount','approval_email','starting_date','social_security','phone','mobile','fax','address','city','region','postal_code','job_titles_id','country_id','active','created_at','updated_at'];


	public function country(){return $this->belongsTo(Countries::class, 'country_id', 'id');}

	public function jobTitle(){return $this->belongsTo(JobTitles::class, 'job_titles_id', 'id');}

	public function nationality(){return $this->belongsTo(Nationalities::class, 'nationality_id', 'id');}
}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	use HasFactory;
	protected $table = 'users';

	protected $connection = 'sims_new';

	protected $fillable = ['id','email','email_verified_at','password','remember_token','created_at','updated_at','mobile_number','max_discount','company_id','tax_rate','identity_number','first_name','last_name','nationality_id','salary','discount','approval_email','starting_date','social_security','phone','mobile','fax','address','city','region','postal_code','job_titles_id','country_id','active','can_access','u_id','second_name','third_name','username','tenant_id'];


	public function company(){return $this->belongsTo(Companies::class, 'company_id', 'id');}

	public function country(){return $this->belongsTo(Countries::class, 'country_id', 'id');}

	public function jobTitle(){return $this->belongsTo(JobTitles::class, 'job_titles_id', 'id');}

	public function nationality(){return $this->belongsTo(Nationalities::class, 'nationality_id', 'id');}
}

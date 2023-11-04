<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'user';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','first_name','last_name','address_details_id','reach_details_id','job_title_id','user_authentication_details_id','basic_salary','job_start_date','second_name','is_social_security','third_name','nationality_option_id','id_number','discount_percentage','is_approval_email'];


	public function jobTitle(){return $this->belongsTo(JobTitle::class, 'job_title_id', 'id');}

	public function reachDetail(){return $this->belongsTo(ReachDetails::class, 'reach_details_id', 'id');}

	public function addressDetail(){return $this->belongsTo(AddressDetails::class, 'address_details_id', 'id');}

	public function UserDocument(){return $this->hasOne(UserDocument::class, 'id', 'id');}

	public function userAuthenticationDetail(){return $this->belongsTo(\App\Models\Crm_setting_schema\UserAuthenticationDetails::class, 'user_authentication_details_id', 'id');}

	public function nationalityOption(){return $this->belongsTo(ListOption::class, 'nationality_option_id', 'id');}
}

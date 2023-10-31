<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReachDetails extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'reach_details';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','email','phone','third_phone','mobile','fax','second_fax','website','second_phone','second_mobile','third_mobile','second_email'];

}

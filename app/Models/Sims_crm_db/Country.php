<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'country';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','phone_code','sales_tax_percentage','name','employee_social_security_deduction','organization_social_Security__deduction'];

}

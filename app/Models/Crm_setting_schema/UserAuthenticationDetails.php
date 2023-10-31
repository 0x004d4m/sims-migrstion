<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuthenticationDetails extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'user_authentication_details';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','password','username','tenant_id'];


	public function tenant(){return $this->belongsTo(Tenant::class, 'tenant_id', 'id');}
}

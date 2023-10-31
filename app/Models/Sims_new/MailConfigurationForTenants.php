<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailConfigurationForTenants extends Model
{
	use HasFactory;
	protected $table = 'mail_configuration_for_tenants';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tenant_id','mail_mailer','mail_host','mail_port','mail_user_name','mail_password','mail_encryption','mail_mail_from_address','created_at','updated_at'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantOutgoingMailServerConfiguration extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'tenant_outgoing_mail_server_configuration';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','authentication_enabled','mail_sender_address','mail_sender_password','mail_sender_username','mail_server_host','mail_server_port','starttls_enabled'];

}

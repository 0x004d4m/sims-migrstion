<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'tenant';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','tenant_identifier','tenant_schema_name','is_active','attachments_folder_path','tenant_outgoing_mail_server_configuration_id','tenant_mailchimp_account_information','tenant_e_store_configuration','tenant_electronics_store_configuration'];


	public function tenantOutgoingMailServerConfiguration(){return $this->belongsTo(TenantOutgoingMailServerConfiguration::class, 'tenant_outgoing_mail_server_configuration_id', 'id');}

	public function TenantEStoreConfiguration(){return $this->hasOne(TenantEStoreConfiguration::class, 'tenant_e_store_configuration', 'id');}

	public function TenantElectronicsStoreConfiguration(){return $this->hasOne(TenantElectronicsStoreConfiguration::class, 'tenant_electronics_store_configuration', 'id');}

	public function TenantMailchimpAccountInformation(){return $this->hasOne(TenantMailchimpAccountInformation::class, 'tenant_mailchimp_account_information', 'id');}
}

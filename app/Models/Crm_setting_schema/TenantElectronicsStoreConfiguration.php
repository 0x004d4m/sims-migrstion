<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantElectronicsStoreConfiguration extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'tenant_electronics_store_configuration';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','about_us_html','contact_us_html','store_domain_name','store_name'];

}

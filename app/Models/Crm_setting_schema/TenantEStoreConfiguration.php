<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantEStoreConfiguration extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'tenant_e_store_configuration';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','about_us_html','contact_us_html','e_store_name','currency_id','location_id','about_us_ar_html','contact_us_ar_html','e_store_domain_name'];

}

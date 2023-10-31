<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantMailchimpAccountInformation extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'tenant_mailchimp_account_information';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['id','email_counter_date','emails_limit_per_month','number_of_emails_sent_this_month','number_of_subscribers','subscribers_limit'];

}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingList extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'mailing_list';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','mailchimp_mailing_list_id'];

}

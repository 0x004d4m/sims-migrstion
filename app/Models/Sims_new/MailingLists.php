<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingLists extends Model
{
	use HasFactory;
	protected $table = 'mailing_lists';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','permission_reminder','company_id','tenant_id','default_subject','default_from_email','default_from_name','default_language','created_at','updated_at','creator_id'];


	public function company(){return $this->belongsTo(Companies::class, 'company_id', 'id');}

	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

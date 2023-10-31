<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmMail extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'crm_mail';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','recipient_email_address','mail_file_name','send_time','lead_id','contact_id','mail_status_id','organization_id','user_id','supplier_organization_id','supplier_contact_id','document_id','related_document_form_id'];


	public function lead(){return $this->belongsTo(Lead::class, 'lead_id', 'id');}

	public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}

	public function supplierOrganization(){return $this->belongsTo(SupplierOrganization::class, 'supplier_organization_id', 'id');}

	public function contact(){return $this->belongsTo(Contact::class, 'contact_id', 'id');}

	public function mailStatus(){return $this->belongsTo(MailStatus::class, 'mail_status_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContact::class, 'supplier_contact_id', 'id');}

	public function organization(){return $this->belongsTo(Organization::class, 'organization_id', 'id');}
}

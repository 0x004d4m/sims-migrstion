<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForQuotation extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'request_for_quotation';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','title','request_date','description','number','supplier_contact_id','supplier_organization_id','request_for_quotation_stage_option_id'];


	public function supplierOrganization(){return $this->belongsTo(SupplierOrganization::class, 'supplier_organization_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContact::class, 'supplier_contact_id', 'id');}

	public function requestForQuotationStageOption(){return $this->belongsTo(ListOption::class, 'request_for_quotation_stage_option_id', 'id');}
}

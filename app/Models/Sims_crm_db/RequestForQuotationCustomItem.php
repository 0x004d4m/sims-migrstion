<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForQuotationCustomItem extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'request_for_quotation_custom_item';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unitPrice','description','name','request_for_quotation_id'];


	public function requestForQuotation(){return $this->belongsTo(RequestForQuotation::class, 'request_for_quotation_id', 'id');}
}

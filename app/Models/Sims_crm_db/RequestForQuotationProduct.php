<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForQuotationProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'request_for_quotation_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','unitPrice','quantity','description','product_id','request_for_quotation_id'];


	public function requestForQuotation(){return $this->belongsTo(RequestForQuotation::class, 'request_for_quotation_id', 'id');}

	public function product(){return $this->belongsTo(Product::class, 'product_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierInvoiceCustomItem extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'supplier_invoice_custom_item';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','description','name','supplier_invoice_id'];


	public function supplierInvoice(){return $this->belongsTo(SupplierInvoice::class, 'supplier_invoice_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierInvoiceProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'supplier_invoice_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','description','supplier_invoice_id','product_id'];


	public function product(){return $this->belongsTo(Product::class, 'product_id', 'id');}

	public function supplierInvoice(){return $this->belongsTo(SupplierInvoice::class, 'supplier_invoice_id', 'id');}
}

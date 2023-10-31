<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'invoice_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','invoice_id','product_id','description'];


	public function product(){return $this->belongsTo(Product::class, 'product_id', 'id');}

	public function invoice(){return $this->belongsTo(Invoice::class, 'invoice_id', 'id');}
}

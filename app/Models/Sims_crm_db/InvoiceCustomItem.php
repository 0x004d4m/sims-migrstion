<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceCustomItem extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'invoice_custom_item';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','name','description','invoice_id'];


	public function invoice(){return $this->belongsTo(Invoice::class, 'invoice_id', 'id');}
}

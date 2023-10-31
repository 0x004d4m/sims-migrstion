<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
	use HasFactory;
	protected $table = 'invoice_items';

	protected $connection = 'sims_new';

	protected $fillable = ['id','itemable_id','itemable_type','item_tax_rate','unit_amount','total_amount','tax_amount','quantity','invoice_id','creator_id','created_at','updated_at'];


	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}

	public function invoice(){return $this->belongsTo(Invoices::class, 'invoice_id', 'id');}
}

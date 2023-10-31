<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceMaid extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'invoice_maid';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','price','maid_id','invoice_id'];


	public function maid(){return $this->belongsTo(Maid::class, 'maid_id', 'id');}

	public function invoice(){return $this->belongsTo(Invoice::class, 'invoice_id', 'id');}
}

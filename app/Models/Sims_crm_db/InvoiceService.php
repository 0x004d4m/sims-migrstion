<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceService extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'invoice_service';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','service_id','invoice_id','description'];


	public function invoice(){return $this->belongsTo(Invoice::class, 'invoice_id', 'id');}

	public function service(){return $this->belongsTo(Service::class, 'service_id', 'id');}
}

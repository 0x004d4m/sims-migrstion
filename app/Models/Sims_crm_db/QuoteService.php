<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteService extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'quote_service';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','service_id','quote_id','description','discount_percentage'];


	public function service(){return $this->belongsTo(Service::class, 'service_id', 'id');}

	public function quote(){return $this->belongsTo(Quote::class, 'quote_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteCustomItem extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'quote_custom_item';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','name','description','quote_id','discount_percentage'];


	public function quote(){return $this->belongsTo(Quote::class, 'quote_id', 'id');}
}

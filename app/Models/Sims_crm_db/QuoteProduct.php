<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteProduct extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'quote_product';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','quantity','unit_price','product_id','quote_id','description','discount_percentage'];


	public function quote(){return $this->belongsTo(Quote::class, 'quote_id', 'id');}

	public function product(){return $this->belongsTo(Product::class, 'product_id', 'id');}
}

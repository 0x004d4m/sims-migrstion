<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRealEstate extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'quote_real_estate';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','price','quote_id','real_estate_id'];


	public function quote(){return $this->belongsTo(Quote::class, 'quote_id', 'id');}

	public function realEstate(){return $this->belongsTo(RealEstate::class, 'real_estate_id', 'id');}
}

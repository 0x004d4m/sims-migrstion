<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteMaid extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'quote_maid';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','price','maid_id','quote_id'];


	public function maid(){return $this->belongsTo(Maid::class, 'maid_id', 'id');}

	public function quote(){return $this->belongsTo(Quote::class, 'quote_id', 'id');}
}

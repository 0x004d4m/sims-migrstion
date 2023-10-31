<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'currencies';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','code','symbol','is_default'];

}

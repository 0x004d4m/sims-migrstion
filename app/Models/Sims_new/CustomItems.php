<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomItems extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'custom_items';

	protected $connection = 'sims_new';

	protected $fillable = ['id','object_type','object_id','name','quantity','unit_price','description','total_price'];

}

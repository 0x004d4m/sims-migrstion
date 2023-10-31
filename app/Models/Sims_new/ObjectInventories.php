<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectInventories extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'object_inventories';

	protected $connection = 'sims_new';

	protected $fillable = ['id','object_type','object_id','inventory_type','inventory_id','quantity','unit_price','total_price','description','tax_rate','sub_total_amount','tenant_id','tax_amount'];

}

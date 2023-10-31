<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreWeightClass extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_weight_class';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','code','display_name','value'];

}

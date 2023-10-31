<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreItemStatus extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_item_status';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','name'];

}

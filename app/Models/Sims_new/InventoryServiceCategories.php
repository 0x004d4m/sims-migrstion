<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryServiceCategories extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'inventory_service_categories';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','tenant_id','u_id'];

}

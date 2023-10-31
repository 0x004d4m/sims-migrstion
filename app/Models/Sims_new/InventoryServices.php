<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryServices extends Model
{
	use HasFactory;
	protected $table = 'inventory_services';

	protected $connection = 'sims_new';

	protected $fillable = ['id','location_id','inventory_service_category_id','usage_unit_id','assigned_user_id','currency_id','number','number_of_units','active','name','website','purchase_cost','description','tenant_id','u_id','tax_rate','created_at','updated_at','unit_price'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function inventoryServiceCategory(){return $this->belongsTo(InventoryServiceCategories::class, 'inventory_service_category_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function usageUnit(){return $this->belongsTo(InventoryServiceUsageUnits::class, 'usage_unit_id', 'id');}
}

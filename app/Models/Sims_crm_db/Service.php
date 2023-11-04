<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'service';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','website','is_active','description','service_price','purchase_cost','number_of_units','name','number','service_usage_unit_id','currency_id','service_category_option_id'];


	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function serviceUsageUnit(){return $this->belongsTo(ServiceUsageUnit::class, 'service_usage_unit_id', 'id');}

	public function serviceCategoryOption(){return $this->belongsTo(ListOption::class, 'service_category_option_id', 'id');}
}

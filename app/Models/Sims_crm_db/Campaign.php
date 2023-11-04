<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'campaign';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','expected_close_date','description','target_audience','target_size','budget_cost','actual_cost','expected_revenue','expected_sales_count','actual_sales_count','expected_response_count','actual_response_count','expected_roi','actual_roi','name','number','currency_id','campaign_status_option_id','campaign_type_option_id','campaign_response_option_id'];


	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function campaignTypeOption(){return $this->belongsTo(ListOption::class, 'campaign_type_option_id', 'id');}

	public function campaignResponseOption(){return $this->belongsTo(ListOption::class, 'campaign_response_option_id', 'id');}

	public function campaignStatusOption(){return $this->belongsTo(ListOption::class, 'campaign_status_option_id', 'id');}
}

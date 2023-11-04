<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'opportunity';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','amount','probability','expected_close_date','weighted_revenue','name','description','contact_id','currency_id','organization_id','campaign_id','opportunity_source_option_id','sales_stage_option_id'];


	public function campaign(){return $this->belongsTo(Campaign::class, 'campaign_id', 'id');}

	public function contact(){return $this->belongsTo(Contact::class, 'contact_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function organization(){return $this->belongsTo(Organization::class, 'organization_id', 'id');}

	public function salesStageOption(){return $this->belongsTo(ListOption::class, 'sales_stage_option_id', 'id');}

	public function opportunitySourceOption(){return $this->belongsTo(ListOption::class, 'opportunity_source_option_id', 'id');}
}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadCampaigns extends Model
{
	use HasFactory;
	protected $table = 'lead_campaigns';

	protected $connection = 'sims_new';

	protected $fillable = ['id','lead_id','campaign_id','active','description','created_at','updated_at'];

}

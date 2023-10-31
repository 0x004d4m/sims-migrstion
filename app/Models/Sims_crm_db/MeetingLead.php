<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingLead extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'meeting_lead';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['meeting_id','lead_id'];


	public function meeting(){return $this->belongsTo(Meeting::class, 'meeting_id', 'id');}

	public function lead(){return $this->belongsTo(Lead::class, 'lead_id', 'id');}
}

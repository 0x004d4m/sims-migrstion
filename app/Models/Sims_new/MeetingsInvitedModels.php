<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingsInvitedModels extends Model
{
	use HasFactory;
	protected $table = 'meetings_invited_models';

	protected $connection = 'sims_new';

	protected $fillable = ['id','invited_type','invited_id','meeting_id','created_at','updated_at'];


	public function meeting(){return $this->belongsTo(Meetings::class, 'meeting_id', 'id');}
}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitedMeetings extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'invited_meetings';

	protected $connection = 'sims_new';

	protected $fillable = ['id','user_id','contact_id','supplier_contact_id','meeting_id'];

}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingUser extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'meeting_user';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['meeting_id','user_id'];


	public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}

	public function meeting(){return $this->belongsTo(Meeting::class, 'meeting_id', 'id');}
}

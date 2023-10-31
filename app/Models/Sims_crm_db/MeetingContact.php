<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingContact extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'meeting_contact';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['meeting_id','contact_id'];


	public function contact(){return $this->belongsTo(Contact::class, 'contact_id', 'id');}

	public function meeting(){return $this->belongsTo(Meeting::class, 'meeting_id', 'id');}
}

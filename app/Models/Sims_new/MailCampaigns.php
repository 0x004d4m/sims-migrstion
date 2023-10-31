<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailCampaigns extends Model
{
	use HasFactory;
	protected $table = 'mail_campaigns';

	protected $connection = 'sims_new';

	protected $fillable = ['id','title','from_email','from_name','subject','content','list_id','status','created_at','updated_at','creator_id'];


	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}

	public function list(){return $this->belongsTo(MailingLists::class, 'list_id', 'id');}
}

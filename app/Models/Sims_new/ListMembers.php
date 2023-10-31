<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListMembers extends Model
{
	use HasFactory;
	protected $table = 'list_members';

	protected $connection = 'sims_new';

	protected $fillable = ['id','list_id','members_type','members_id','created_at','updated_at'];


	public function list(){return $this->belongsTo(MailingLists::class, 'list_id', 'id');}
}

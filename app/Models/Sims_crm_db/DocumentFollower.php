<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentFollower extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'document_follower';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['document_id','user_id'];


	public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}

	public function document(){return $this->belongsTo(Document::class, 'document_id', 'id');}
}

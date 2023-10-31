<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'document';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','location_id','user_id','create_time','last_edit_time','last_editor_id','creator_id'];


	public function creator(){return $this->belongsTo(User::class, 'creator_id', 'id');}

	public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}

	public function location(){return $this->belongsTo(Location::class, 'location_id', 'id');}

	public function lastEditor(){return $this->belongsTo(User::class, 'last_editor_id', 'id');}
}

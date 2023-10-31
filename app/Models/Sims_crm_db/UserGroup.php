<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'user_group';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['group_id','user_id'];


	public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}

	public function group(){return $this->belongsTo(CrmGroup::class, 'group_id', 'id');}
}

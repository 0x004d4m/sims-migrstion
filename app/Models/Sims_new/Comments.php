<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'comments';

	protected $connection = 'sims_new';

	protected $fillable = ['id','comment','object_type','object_id','creator_id','created_at','updated_at','deleted_at'];


	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}
}

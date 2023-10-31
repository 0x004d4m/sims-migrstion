<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'transactions';

	protected $connection = 'sims_new';

	protected $fillable = ['id','unit_price','amount','quantity','type','object_type','object_id','comments','creator_id','status','deleted_at','created_at','updated_at'];


	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}
}

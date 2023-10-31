<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
{
	use HasFactory;
	protected $table = 'campaigns';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','status','date','announce_before','slug','announce_before_time','created_at','updated_at'];

}

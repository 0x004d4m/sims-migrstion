<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
	use HasFactory;
	protected $table = 'jobs';

	protected $connection = 'sims_new';

	protected $fillable = ['id','queue','payload','attempts','reserved_at','available_at','created_at'];

}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CacheLocks extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'cache_locks';

	protected $connection = 'sims_new';

	protected $fillable = ['key','owner','expiration'];

}

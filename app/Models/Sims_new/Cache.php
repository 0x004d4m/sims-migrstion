<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cache extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'cache';

	protected $connection = 'sims_new';

	protected $fillable = ['key','value','expiration'];

}

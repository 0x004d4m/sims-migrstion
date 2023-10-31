<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migrations extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'migrations';

	protected $connection = 'sims_new';

	protected $fillable = ['id','migration','batch'];

}

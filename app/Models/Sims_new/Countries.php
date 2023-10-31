<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'countries';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','active'];

}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalities extends Model
{
	use HasFactory;
	protected $table = 'nationalities';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','active','created_at','updated_at'];

}

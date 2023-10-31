<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesModes extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'expenses_modes';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name'];

}

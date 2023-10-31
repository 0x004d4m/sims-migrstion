<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesCategories extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'expenses_categories';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','u_id','tenant_id'];

}

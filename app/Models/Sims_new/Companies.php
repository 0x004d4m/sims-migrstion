<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'companies';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','description','phone','email','address','tax_number','tax_rate','logo','active','created_at','updated_at','deleted_at','state','city','zip_code'];

}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreDivision extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_division';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','name','thumbnail_image_file_name'];

}

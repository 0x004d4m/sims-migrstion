<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreBanner extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_banner';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','is_active','description','image_file_name','link','sort_order','title'];

}

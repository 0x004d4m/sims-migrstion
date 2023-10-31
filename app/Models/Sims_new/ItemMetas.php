<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMetas extends Model
{
	use HasFactory;
	protected $table = 'item_metas';

	protected $connection = 'sims_new';

	protected $fillable = ['id','key','value','item_type','item_id','created_at','updated_at'];

}

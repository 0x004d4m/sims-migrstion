<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeImages extends Model
{
	use HasFactory;
	protected $table = 'office_images';

	protected $connection = 'sims_new';

	protected $fillable = ['id','url','office_id','created_at','updated_at'];


	public function office(){return $this->belongsTo(Offices::class, 'office_id', 'id');}
}

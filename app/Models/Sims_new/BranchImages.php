<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchImages extends Model
{
	use HasFactory;
	protected $table = 'branch_images';

	protected $connection = 'sims_new';

	protected $fillable = ['id','url','branch_id','sort','created_at','updated_at'];


	public function branch(){return $this->belongsTo(Branches::class, 'branch_id', 'id');}
}

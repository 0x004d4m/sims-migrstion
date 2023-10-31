<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
	use HasFactory;
	protected $table = 'offices';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','description','capacity','dimension_id','branch_id','image','user_id','created_at','updated_at','tax_rate'];


	public function branch(){return $this->belongsTo(Branches::class, 'branch_id', 'id');}

	public function dimension(){return $this->belongsTo(Dimensions::class, 'dimension_id', 'id');}

	public function user(){return $this->belongsTo(Users::class, 'user_id', 'id');}
}

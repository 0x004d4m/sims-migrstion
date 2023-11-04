<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'department';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['name','id'];


	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}
}

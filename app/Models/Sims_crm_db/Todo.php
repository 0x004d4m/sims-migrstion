<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'todo';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['is_completed','description','subject','time','id'];


	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HibernateSequence extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'hibernate_sequence';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['next_val'];

}

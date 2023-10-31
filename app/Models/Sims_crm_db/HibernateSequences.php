<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HibernateSequences extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'hibernate_sequences';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['sequence_name','next_val'];

}

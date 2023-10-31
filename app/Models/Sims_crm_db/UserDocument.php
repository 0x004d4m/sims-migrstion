<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'user_document';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','disabled','is_group'];

}

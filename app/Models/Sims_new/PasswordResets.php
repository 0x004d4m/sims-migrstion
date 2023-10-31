<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
	use HasFactory;
	protected $table = 'password_resets';

	protected $connection = 'sims_new';

	protected $fillable = ['email','token','created_at'];

}

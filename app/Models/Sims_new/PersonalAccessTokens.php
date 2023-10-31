<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessTokens extends Model
{
	use HasFactory;
	protected $table = 'personal_access_tokens';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tokenable_type','tokenable_id','name','token','abilities','last_used_at','created_at','updated_at','expires_at'];

}

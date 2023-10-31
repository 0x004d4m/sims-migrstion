<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
	use HasFactory;
	protected $table = 'services';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','description','image','price','term','is_active','user_id','created_at','updated_at','tax_rate','tenant_id'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}

	public function user(){return $this->belongsTo(Users::class, 'user_id', 'id');}
}

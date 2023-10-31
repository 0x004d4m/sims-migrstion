<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locations extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'locations';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','tax_rate','tax_free','description','active','tenant_id','created_at','updated_at','deleted_at','u_id','country_id','currency_id'];


	public function country(){return $this->belongsTo(Countries::class, 'country_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

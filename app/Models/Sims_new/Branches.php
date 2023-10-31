<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
	use HasFactory;
	protected $table = 'branches';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','description','logo','tel','email','location','active','created_at','updated_at','company_id','tax_rate','location_id','tenant_id'];


	public function company(){return $this->belongsTo(Companies::class, 'company_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

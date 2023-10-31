<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteStages extends Model
{
	use HasFactory;
	protected $table = 'quote_stages';

	protected $connection = 'sims_new';

	protected $fillable = ['id','tenant_id','name','created_at','updated_at','u_id'];


	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

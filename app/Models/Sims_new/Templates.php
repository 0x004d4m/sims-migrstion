<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Templates extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'templates';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','active','is_common','template_type_id','html','logo','location_id','tenant_id','created_at','updated_at','deleted_at','u_id'];


	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function templateType(){return $this->belongsTo(TemplateTypes::class, 'template_type_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantModule extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'tenant_module';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['tenant_id','module_id'];


	public function module(){return $this->belongsTo(ModuleSetting::class, 'module_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenant::class, 'tenant_id', 'id');}
}

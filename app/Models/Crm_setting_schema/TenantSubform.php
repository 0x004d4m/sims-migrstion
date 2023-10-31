<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantSubform extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'tenant_subform';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['tenant_id','subform_id'];


	public function tenant(){return $this->belongsTo(Tenant::class, 'tenant_id', 'id');}

	public function subform(){return $this->belongsTo(SubformSetting::class, 'subform_id', 'id');}
}

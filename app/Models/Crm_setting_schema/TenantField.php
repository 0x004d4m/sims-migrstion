<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantField extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'tenant_field';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['tenant_id','field_id'];


	public function tenant(){return $this->belongsTo(Tenant::class, 'tenant_id', 'id');}

	public function field(){return $this->belongsTo(FieldSetting::class, 'field_id', 'id');}
}

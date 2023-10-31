<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantForm extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'tenant_form';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['tenant_id','form_id'];


	public function tenant(){return $this->belongsTo(Tenant::class, 'tenant_id', 'id');}

	public function form(){return $this->belongsTo(FormSetting::class, 'form_id', 'id');}
}

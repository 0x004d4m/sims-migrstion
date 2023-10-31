<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleManager extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'module_manager';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['module_id','user_document_id'];


	public function userDocument(){return $this->belongsTo(UserDocument::class, 'user_document_id', 'id');}

	public function module(){return $this->belongsTo(\App\Models\Crm_setting_schema\ModuleSetting::class, 'module_id', 'id');}
}

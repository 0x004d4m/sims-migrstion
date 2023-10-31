<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormManager extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'form_manager';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['form_id','user_document_id'];


	public function userDocument(){return $this->belongsTo(UserDocument::class, 'user_document_id', 'id');}

	public function form(){return $this->belongsTo(\App\Models\Crm_setting_schema\FormSetting::class, 'form_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormEditor extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'form_editor';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['form_id','user_document_id'];


	public function form(){return $this->belongsTo(\App\Models\Crm_setting_schema\FormSetting::class, 'form_id', 'id');}

	public function userDocument(){return $this->belongsTo(UserDocument::class, 'user_document_id', 'id');}
}

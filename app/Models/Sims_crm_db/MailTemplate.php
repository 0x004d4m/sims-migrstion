<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'mail_template';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','is_common','logo_file_name','name','is_active','template_html','form_id'];


	public function form(){return $this->belongsTo(\App\Models\Crm_setting_schema\FormSetting::class, 'form_id', 'id');}
}

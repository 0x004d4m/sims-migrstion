<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewReader extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'view_reader';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['view_id','user_document_id'];


	public function userDocument(){return $this->belongsTo(UserDocument::class, 'user_document_id', 'id');}

	public function view(){return $this->belongsTo(\App\Models\Crm_setting_schema\ViewSetting::class, 'view_id', 'id');}
}

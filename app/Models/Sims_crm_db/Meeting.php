<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'meeting';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','end_time','location','title','start_time','description','document_id','related_document_form_id'];


	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}
}

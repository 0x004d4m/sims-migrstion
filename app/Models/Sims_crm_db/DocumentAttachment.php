<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAttachment extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'document_attachment';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','upload_time','file_name','user_id','document_id'];


	public function document(){return $this->belongsTo(Document::class, 'document_id', 'id');}

	public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}
}

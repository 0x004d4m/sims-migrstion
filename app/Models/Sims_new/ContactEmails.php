<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEmails extends Model
{
	use HasFactory;
	protected $table = 'contact_emails';

	protected $connection = 'sims_new';

	protected $fillable = ['id','email','alternativet_email1','alternativet_email2','contact_id','created_at','updated_at'];


	public function contact(){return $this->belongsTo(Contacts::class, 'contact_id', 'id');}
}

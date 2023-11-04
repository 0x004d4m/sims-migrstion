<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreUser extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_user';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','address','city','email','first_name','last_name','mobile','password','postal_code','state','country_id','latitude','longitude'];


	public function country(){return $this->belongsTo(Country::class, 'country_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}
}

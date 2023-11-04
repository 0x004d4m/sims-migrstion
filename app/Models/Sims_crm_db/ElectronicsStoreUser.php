<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreUser extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_user';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['address','city','email','first_name','last_name','latitude','longitude','mobile','password','postal_code','state','id','country_id','electronics_store_user_status_id'];


	public function electronicsStoreUserStatus(){return $this->belongsTo(ElectronicsStoreUserStatus::class, 'electronics_store_user_status_id', 'id');}

	public function country(){return $this->belongsTo(Country::class, 'country_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}
}

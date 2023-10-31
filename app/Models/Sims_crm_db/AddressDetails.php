<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDetails extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'address_details';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','city','postal_code','post_office_box','state','address','country_id'];


	public function country(){return $this->belongsTo(Country::class, 'country_id', 'id');}
}

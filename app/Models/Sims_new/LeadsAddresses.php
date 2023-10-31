<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsAddresses extends Model
{
	use HasFactory;
	protected $table = 'leads_addresses';

	protected $connection = 'sims_new';

	protected $fillable = ['id','lead_id','country_id','address_info','state','city','postal_code','po_box','created_at','updated_at'];


	public function country(){return $this->belongsTo(Countries::class, 'country_id', 'id');}

	public function lead(){return $this->belongsTo(Leads::class, 'lead_id', 'id');}
}

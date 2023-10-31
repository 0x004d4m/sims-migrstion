<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'location';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','city','name','description','reach_details_id','country_id','currency_id'];


	public function reachDetail(){return $this->belongsTo(ReachDetails::class, 'reach_details_id', 'id');}

	public function country(){return $this->belongsTo(Country::class, 'country_id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}
}

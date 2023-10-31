<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenants extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'tenants';

	protected $connection = 'sims_new';

	protected $fillable = ['id','name','description','domain','lock','created_at','updated_at','deleted_at','tax_free','tax_rate','address','primary_email','primary_phone','currency_id','primary_logo','secondary_logo','theme','title','copyright','valid_until','number_of_users','country_id','password','start_date','end_date'];


	public function country(){return $this->belongsTo(Countries::class, 'country_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}
}

<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotations extends Model
{
	use HasFactory;
	protected $table = 'quotations';

	protected $connection = 'sims_new';

	protected $fillable = ['id','reference','status','date','number_of_days','number_of_persons','email_send_datetime','price_calculation','unit_price','sale_tax_percentage','contact_id','created_at','updated_at'];


	public function contact(){return $this->belongsTo(Contacts::class, 'contact_id', 'id');}
}

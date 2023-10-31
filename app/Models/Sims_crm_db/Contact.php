<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'contact';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','person_id','lead_id','starting_balance','starting_balance_date','currency_id','account_number','is_tax_free','tax_number'];


	public function person(){return $this->belongsTo(Person::class, 'person_id', 'id');}

	public function lead(){return $this->belongsTo(Lead::class, 'lead_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'lead';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','converted_to_contact','description','person_id','lead_source_option_id','lead_status_option_id'];


	public function person(){return $this->belongsTo(Person::class, 'person_id', 'id');}

	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function leadStatusOption(){return $this->belongsTo(ListOption::class, 'lead_status_option_id', 'id');}

	public function leadSourceOption(){return $this->belongsTo(ListOption::class, 'lead_source_option_id', 'id');}
}

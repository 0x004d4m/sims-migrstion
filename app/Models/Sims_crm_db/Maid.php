<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maid extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'maid';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['age','description','education','experience','full_name','is_hired','number','id','maid_marital_status_option_id','maid_nationality_option_id','maid_religion_option_id'];


	public function maidReligionOption(){return $this->belongsTo(ListOption::class, 'maid_religion_option_id', 'id');}

	public function maidNationalityOption(){return $this->belongsTo(ListOption::class, 'maid_nationality_option_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function maidMaritalStatusOption(){return $this->belongsTo(ListOption::class, 'maid_marital_status_option_id', 'id');}
}

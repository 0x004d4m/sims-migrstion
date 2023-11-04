<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicamentPatient extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'medicament_patient';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','medicament_description','medicament_option_id','medical_file_id','quantity','medicament_product'];


	public function medicamentOption(){return $this->belongsTo(ListOption::class, 'medicament_option_id', 'id');}

	public function medicalFile(){return $this->belongsTo(MedicalFile::class, 'medical_file_id', 'id');}

	public function Product(){return $this->hasOne(Product::class, 'medicament_product', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefillMedicament extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'refill_medicament';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','description','due_date','quantity','medicament_product','medical_file_id'];


	public function Products(){return $this->hasMany(Product::class, 'medicament_product', 'id');}

	public function medicalFile(){return $this->belongsTo(MedicalFile::class, 'medical_file_id', 'id');}
}

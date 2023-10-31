<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingSupplierContact extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'meeting_supplier_contact';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['meeting_id','supplier_contact_id'];


	public function meeting(){return $this->belongsTo(Meeting::class, 'meeting_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContact::class, 'supplier_contact_id', 'id');}
}

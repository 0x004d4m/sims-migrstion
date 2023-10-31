<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContacts extends Model
{
	use HasFactory;
	protected $table = 'supplier_contacts';

	protected $connection = 'sims_new';

	protected $fillable = ['id','location_id','supplier_category_id','supplier_organisation_id','assigned_user_id','tenant_id','first_name','last_name','description','tax_free','primary_email','primary_mobile','primary_phone','primary_fax','website','tax_number','tax_rate','created_at','updated_at','starting_balance','starting_balance_date','currency_id','u_id','account_number'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function supplierCategory(){return $this->belongsTo(SupplierCategories::class, 'supplier_category_id', 'id');}

	public function supplierOrganisation(){return $this->belongsTo(SupplierOrganisations::class, 'supplier_organisation_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

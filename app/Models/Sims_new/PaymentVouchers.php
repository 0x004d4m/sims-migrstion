<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVouchers extends Model
{
	use HasFactory;
	protected $table = 'payment_vouchers';

	protected $connection = 'sims_new';

	protected $fillable = ['id','location_id','assigned_user_id','supplier_organisation_id','supplier_contact_id','currency_id','payment_method_id','subject','number','payment_date','description','cash_amount','total_amount','created_at','updated_at'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function paymentMethod(){return $this->belongsTo(PaymentMethods::class, 'payment_method_id', 'id');}

	public function supplierContact(){return $this->belongsTo(SupplierContacts::class, 'supplier_contact_id', 'id');}

	public function supplierOrganisation(){return $this->belongsTo(SupplierOrganisations::class, 'supplier_organisation_id', 'id');}
}

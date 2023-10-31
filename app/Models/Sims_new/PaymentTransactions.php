<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentTransactions extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'payment_transactions';

	protected $connection = 'sims_new';

	protected $fillable = ['id','type','location_id','tenant_id','amount','vat','payment_method_id','cheqable_type','cheqable_id','currency_id','accountable_type','accountable_id','subject','description','is_paid','due_date','paid_at','creator_id','created_at','updated_at','deleted_at','expenses_mode_id','assigned_user_id'];


	public function assignedUser(){return $this->belongsTo(Users::class, 'assigned_user_id', 'id');}

	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}

	public function currency(){return $this->belongsTo(Currencies::class, 'currency_id', 'id');}

	public function expensesMode(){return $this->belongsTo(ExpensesModes::class, 'expenses_mode_id', 'id');}

	public function location(){return $this->belongsTo(Locations::class, 'location_id', 'id');}

	public function tenant(){return $this->belongsTo(Tenants::class, 'tenant_id', 'id');}
}

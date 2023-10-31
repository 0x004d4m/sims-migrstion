<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
	use HasFactory;
	protected $table = 'invoices';

	protected $connection = 'sims_new';

	protected $fillable = ['id','unique_id','number','invoice_to_name','invoice_to_email','invoice_to_phone','due_date','tax_rate','sub_total','total_tax','discount_rate','total_discount','total','comments','internal_comments','pdf_link','branch_id','creator_id','is_paid','paid_at','paid_by_id','status_id','created_at','updated_at'];


	public function branch(){return $this->belongsTo(Branches::class, 'branch_id', 'id');}

	public function creator(){return $this->belongsTo(Users::class, 'creator_id', 'id');}

	public function paidBy(){return $this->belongsTo(Users::class, 'paid_by_id', 'id');}

	public function status(){return $this->belongsTo(InvoiceStatuses::class, 'status_id', 'id');}
}

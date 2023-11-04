<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVoucherReports extends Model
{
	use HasFactory;
	protected $table = 'payment_voucher_reports';

	protected $connection = 'sims_new';

	protected $fillable = ['id','u_id','tenant_id','payment_method_id','location_id','payment_date','voucher_number','total_amount','report_type','report_id','created_at','updated_at'];

}

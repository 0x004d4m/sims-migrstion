<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingMonths extends Model
{
	use HasFactory;
	protected $table = 'booking_months';

	protected $connection = 'sims_new';

	protected $fillable = ['id','start_datetime','end_datetime','booking_id','price','price_calculation_method','created_at','updated_at','tax_rate','invoice_id','bookable_type','bookable_id','status_id'];


	public function booking(){return $this->belongsTo(Bookings::class, 'booking_id', 'id');}

	public function invoice(){return $this->belongsTo(Invoices::class, 'invoice_id', 'id');}

	public function status(){return $this->belongsTo(BookingStatuses::class, 'status_id', 'id');}
}

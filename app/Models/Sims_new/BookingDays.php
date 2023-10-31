<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDays extends Model
{
	use HasFactory;
	protected $table = 'booking_days';

	protected $connection = 'sims_new';

	protected $fillable = ['id','date','start_time','end_time','booking_id','price_calculation_method','quantity','unit_price','price','actual_number_of_attendees','created_at','updated_at','tax_rate','invoice_id','setup_id','bookable_type','bookable_id','status_id'];


	public function booking(){return $this->belongsTo(Bookings::class, 'booking_id', 'id');}

	public function invoice(){return $this->belongsTo(Invoices::class, 'invoice_id', 'id');}

	public function setup(){return $this->belongsTo(RoomSetupRelations::class, 'setup_id', 'id');}

	public function status(){return $this->belongsTo(BookingStatuses::class, 'status_id', 'id');}
}

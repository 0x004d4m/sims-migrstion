<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAddons extends Model
{
	use HasFactory;
	protected $table = 'booking_addons';

	protected $connection = 'sims_new';

	protected $fillable = ['id','booking_id','addon_id','unit_price','quantity','price','date','start_time','created_at','updated_at','days','invoice_id','bookable_type','bookable_id'];


	public function addon(){return $this->belongsTo(Addons::class, 'addon_id', 'id');}

	public function booking(){return $this->belongsTo(Bookings::class, 'booking_id', 'id');}

	public function invoice(){return $this->belongsTo(Invoices::class, 'invoice_id', 'id');}
}

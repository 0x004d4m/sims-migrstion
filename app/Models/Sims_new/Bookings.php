<?php

namespace App\Models\Sims_new;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
	use HasFactory;
	protected $table = 'bookings';

	protected $connection = 'sims_new';

	protected $fillable = ['id','contact_id','start_datetime','end_datetime','number_of_persons','notes','internal_notes','actual_number_of_attendees','invoice_name','logo','setup_id','bookable_id','branch_id','status','created_at','updated_at','bookable_bookings_id','number_of_days','number_of_hours','number_of_hour_per_day','total_price','unit_price','discount','discount_type','price_calculation_method','bookable_type','term','opportunity_id'];


	public function branch(){return $this->belongsTo(Branches::class, 'branch_id', 'id');}

	public function contact(){return $this->belongsTo(Contacts::class, 'contact_id', 'id');}

	public function opportunity(){return $this->belongsTo(Opportunities::class, 'opportunity_id', 'id');}

	public function bookable(){return $this->belongsTo(Rooms::class, 'bookable_id', 'id');}

	public function setup(){return $this->belongsTo(RoomSetupRelations::class, 'setup_id', 'id');}
}

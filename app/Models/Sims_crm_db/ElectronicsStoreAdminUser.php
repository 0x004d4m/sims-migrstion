<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreAdminUser extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_admin_user';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','email','first_name','last_name','mobile','password','username','electronics_store_user_status_id'];


	public function electronicsStoreUserStatus(){return $this->belongsTo(ElectronicsStoreUserStatus::class, 'electronics_store_user_status_id', 'id');}
}

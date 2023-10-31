<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicsStoreAttribute extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'electronics_store_attribute';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','name','sort_order','electronics_store_attribute_group_id'];


	public function electronicsStoreAttributeGroup(){return $this->belongsTo(ElectronicsStoreAttributeGroup::class, 'electronics_store_attribute_group_id', 'id');}
}

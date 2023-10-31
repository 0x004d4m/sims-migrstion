<?php

namespace App\Models\Crm_setting_schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EStoreHomePageBannerImage extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'e_store_home_page_banner_image';

	protected $connection = 'crm_setting_schema';

	protected $fillable = ['e_store_id','banner_image_file_name'];


	public function eStore(){return $this->belongsTo(TenantEStoreConfiguration::class, 'e_store_id', 'id');}
}

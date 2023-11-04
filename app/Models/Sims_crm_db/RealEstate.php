<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'real_estate';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['area','description','location','name','number','price','is_sold','id','currency_id','real_estate_category_option_id'];


	public function Document(){return $this->hasOne(Document::class, 'id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function realEstateCategoryOption(){return $this->belongsTo(ListOption::class, 'real_estate_category_option_id', 'id');}
}

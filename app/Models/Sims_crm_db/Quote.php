<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'quote';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','subject','expiry_date','number','description','contact_id','opportunity_id','currency_id','organization_id','lead_id','sales_tax_percentage','subtotal_amount','total_amount','quote_stage_option_id','media_tax_percentage'];


	public function quoteStageOption(){return $this->belongsTo(ListOption::class, 'quote_stage_option_id', 'id');}

	public function opportunity(){return $this->belongsTo(Opportunity::class, 'opportunity_id', 'id');}

	public function lead(){return $this->belongsTo(Lead::class, 'lead_id', 'id');}

	public function contact(){return $this->belongsTo(Contact::class, 'contact_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}

	public function organization(){return $this->belongsTo(Organization::class, 'organization_id', 'id');}
}

<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'project';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['id','due_date','start_date','title','description','opportunity_id','organization_id','contact_id','sales_order_id','project_status_option_id'];


	public function salesOrder(){return $this->belongsTo(SalesOrder::class, 'sales_order_id', 'id');}

	public function organization(){return $this->belongsTo(Organization::class, 'organization_id', 'id');}

	public function opportunity(){return $this->belongsTo(Opportunity::class, 'opportunity_id', 'id');}

	public function contact(){return $this->belongsTo(Contact::class, 'contact_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function projectStatusOption(){return $this->belongsTo(ListOption::class, 'project_status_option_id', 'id');}
}

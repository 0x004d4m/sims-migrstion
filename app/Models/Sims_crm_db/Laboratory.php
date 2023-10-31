<?php

namespace App\Models\Sims_crm_db;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
	use HasFactory;
	public $timestamps = false;

	protected $table = 'laboratory';

	protected $connection = 'sims_crm_db';

	protected $fillable = ['chemistry_albumin','chemistry_alp','chemistry_alt','chemistry_amylase','chemistry_ast','chemistry_bilirubin_total','chemistry_bilirubin_total_neonatal','chemistry_blood_glucose','chemistry_calcium','chemistry_cholesterol','chemistry_ck','chemistry_creatinine','chemistry_electrolytes_cl','chemistry_electrolytes_k','chemistry_electrolytes_na','chemistry_ggt','chemistry_total_protein','chemistry_triglycerdes','chemistry_urea','chemistry_uric_acid','csf_analysis_appearance','csf_analysis_erytrocytes','csf_analysis_leukocytes','description','is_flag_edit','hematology_bleeding_time','hematology_blood_grouping','hematology_cbc_hb','hematology_clotting_time','hematology_esr','hematology_mch','hematology_mchc','hematology_mcv','hematology_pcv','hematology_platelet_count','hematology_pt','hematology_ptt','hematology_rbc','hematology_wbc','hematology_wbc_diff','immunology_asot','immunology_bhcg_serum_or_urine','immunology_brucell_test','immunology_crp_rapid_test','immunology_haigm_rapid_test','immunology_hbsag_rapid_test','immunology_hcv_rapid_test','immunology_hiv_rapid_test','immunology_malaria_rapid_test','immunology_rf','immunology_syphilis_rapid_test','immunology_troponin_i','immunology_troponin_t','immunology_widel_test','stool_analysis_adenovirus','stool_analysis_appearance','stool_analysis_color','stool_analysis_erythrocytes','stool_analysis_leukocy_test','stool_analysis_occult_blood','stool_analysis_other','stool_analysis_rotavirus','urine_analysis_appearance','urine_analysis_bilirubin','urine_analysis_blood','urine_analysis_color','urine_analysis_erytrocytes','urine_analysis_glucosc','urine_analysis_ketone','urine_analysis_leucocytes','urine_analysis_microscopic_leukocytes','urine_analysis_nitrite','urine_analysis_other','urine_analysis_ph','urine_analysis_protein','urine_analysis_specic_gravity','urine_analysis_urobilinogen','id','patient_id','medical_file_id'];


	public function patient(){return $this->belongsTo(Patient::class, 'patient_id', 'id');}

	public function Documents(){return $this->hasMany(Document::class, 'id', 'id');}

	public function medicalFile(){return $this->belongsTo(MedicalFile::class, 'medical_file_id', 'id');}
}

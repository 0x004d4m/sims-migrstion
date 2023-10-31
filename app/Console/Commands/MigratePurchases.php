<?php

namespace App\Console\Commands;

use App\Models\Sims_crm_db\{
    PurchaseOrder,
    RequestForQuotation,
    SupplierInvoice
};
use App\Models\Sims_new\{
    Currencies,
    Locations,
    PurchaseOrderInvoices,
    PurchaseOrders,
    PurchaseOrderStatuses,
    RequestForQuotations,
    RequestForQuotationStages
};
use Illuminate\Console\Command;
use function Laravel\Prompts\info;
use function Laravel\Prompts\progress;

class MigratePurchases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sims:migrate-purchases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate purchases from old to new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        info('Starting Purchases Migration');


        $progress = progress(label: 'Migrating Request For Quotations', steps: RequestForQuotation::count());
        $progress->start();
        foreach (RequestForQuotation::get() as $RequestForQuotation) {
            if ($RequestForQuotation->requestForQuotationStageOption) {
                if (RequestForQuotationStages::where('name', str_replace("'","",str_replace('"','',$RequestForQuotation->requestForQuotationStageOption->description)))->count() == 0) {
                    RequestForQuotationStages::create([
                        'name' => str_replace("'","",str_replace('"','',$RequestForQuotation->requestForQuotationStageOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (RequestForQuotationStages::where('name', "-")->count() == 0) {
                    RequestForQuotationStages::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $RequestForQuotation->supplierOrganization ? ($RequestForQuotation->supplierOrganization->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$RequestForQuotation->supplierOrganization->currency->currency_code)))->first()->id) : 1) : 1;
            $country = $RequestForQuotation->supplierOrganization ? ($RequestForQuotation->supplierOrganization->addressDetail ? $RequestForQuotation->supplierOrganization->addressDetail->country_id : 1) : 1;
            if (Locations::where('country_id', $country)->where('currency_id', $currency)->count() == 0) {
                $Location = Locations::create([
                    'name' => "-",
                    'tax_rate' => 0.16,
                    'tax_free' => 0,
                    'description' => "-",
                    'active' => 1,
                    'tenant_id' => 1,
                    'country_id' => $country,
                    'currency_id' => $currency,
                ]);
            } else {
                $Location = Locations::where('country_id', $country)->where('currency_id', $currency)->first();
            }
            RequestForQuotations::create([
                'id' => str_replace("'","",str_replace('"','',$RequestForQuotation->id)),
                'location_id' => $Location->id,
                'assigned_user_id' => 1,
                'supplier_contact_id' => $RequestForQuotation->supplier_contact_id,
                'supplier_organisation_id' => $RequestForQuotation->supplier_organization_id,
                'request_for_quotation_stage_id' => $RequestForQuotation->requestForQuotationStageOption ? RequestForQuotationStages::where('name', str_replace("'","",str_replace('"','',$RequestForQuotation->requestForQuotationStageOption->description)))->first()->id : RequestForQuotationStages::where('name', "-")->first()->id,
                'title' => str_replace("'","",str_replace('"','',$RequestForQuotation->title)),
                'number' => str_replace("'","",str_replace('"','',$RequestForQuotation->number)),
                'request_date' => $RequestForQuotation->request_date,
                'description' => str_replace("'","",str_replace('"','',$RequestForQuotation->description)),
                'tenant_id' => 1,
            ]);
            $progress->advance();
            unset($RequestForQuotation);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Purchase Orders', steps: PurchaseOrder::count());
        $progress->start();
        foreach (PurchaseOrder::get() as $PurchaseOrder) {
            if ($PurchaseOrder->purchaseOrderStatusOption) {
                if (PurchaseOrderStatuses::where('name', str_replace("'","",str_replace('"','',$PurchaseOrder->purchaseOrderStatusOption->description)))->count() == 0) {
                    PurchaseOrderStatuses::create([
                        'name' => str_replace("'","",str_replace('"','',$PurchaseOrder->purchaseOrderStatusOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (PurchaseOrderStatuses::where('name', "-")->count() == 0) {
                    PurchaseOrderStatuses::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $PurchaseOrder->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$PurchaseOrder->currency->currency_code)))->first()->id) : 1;
            $country = $PurchaseOrder->contact ? ($PurchaseOrder->contact->person ? ($PurchaseOrder->contact->person->addressDetail ? $PurchaseOrder->contact->person->addressDetail->country_id : 1) : 1) : 1;
            if (Locations::where('country_id', $country)->where('currency_id', $currency)->count() == 0) {
                $Location = Locations::create([
                    'name' => "-",
                    'tax_rate' => 0.16,
                    'tax_free' => 0,
                    'description' => "-",
                    'active' => 1,
                    'tenant_id' => 1,
                    'country_id' => $country,
                    'currency_id' => $currency,
                ]);
            } else {
                $Location = Locations::where('country_id', $country)->where('currency_id', $currency)->first();
            }
            PurchaseOrders::create([
                'id' => str_replace("'","",str_replace('"','',$PurchaseOrder->id)),
                'location_id' => $Location->id,
                'purchase_order_status_id' => $PurchaseOrder->purchaseOrderStatusOption ? PurchaseOrderStatuses::where('name', str_replace("'","",str_replace('"','',$PurchaseOrder->purchaseOrderStatusOption->description)))->first()->id : PurchaseOrderStatuses::where('name', "-")->first()->id,
                'assigned_user_id' => 1,
                'currency_id' => $currency,
                'supplier_contact_id' => $PurchaseOrder->supplier_contact_id,
                'supplier_organisation_id' => $PurchaseOrder->supplier_organization_id,
                'subject' => str_replace("'","",str_replace('"','',$PurchaseOrder->subject)),
                'number' => str_replace("'","",str_replace('"','',$PurchaseOrder->number)),
                'due_date' => $PurchaseOrder->due_date,
                'subtotal_amount' => $PurchaseOrder->subtotal_amount,
                'sales_tax_percentage' => $PurchaseOrder->sales_tax_percentage,
                'total_amount' => $PurchaseOrder->total_amount,
                'description' => str_replace("'","",str_replace('"','',$PurchaseOrder->description)),
                'tenant_id' => 1,
                'request_for_quotation_id' => $PurchaseOrder->request_for_quotation_id,
            ]);
            $progress->advance();
            unset($PurchaseOrder);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Supplier Invoices', steps: SupplierInvoice::count());
        $progress->start();
        foreach (SupplierInvoice::get() as $SupplierInvoice) {
            if ($SupplierInvoice->purchaseOrderStatusOption) {
                if (PurchaseOrderStatuses::where('name', str_replace("'","",str_replace('"','',$SupplierInvoice->purchaseOrderStatusOption->description)))->count() == 0) {
                    PurchaseOrderStatuses::create([
                        'name' => str_replace("'","",str_replace('"','',$SupplierInvoice->purchaseOrderStatusOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (PurchaseOrderStatuses::where('name', "-")->count() == 0) {
                    PurchaseOrderStatuses::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $SupplierInvoice->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$SupplierInvoice->currency->currency_code)))->first()->id) : 1;
            $country = $SupplierInvoice->supplierContact ? ($SupplierInvoice->supplierContact->addressDetail ? $SupplierInvoice->supplierContact->addressDetail->country_id : 1) : 1;
            if (Locations::where('country_id', $country)->where('currency_id', $currency)->count() == 0) {
                $Location = Locations::create([
                    'name' => "-",
                    'tax_rate' => 0.16,
                    'tax_free' => 0,
                    'description' => "-",
                    'active' => 1,
                    'tenant_id' => 1,
                    'country_id' => $country,
                    'currency_id' => $currency,
                ]);
            } else {
                $Location = Locations::where('country_id', $country)->where('currency_id', $currency)->first();
            }
            PurchaseOrderInvoices::create([
                'id' => $SupplierInvoice->id,
                'purchase_order_id' => $SupplierInvoice->purchase_order_id,
                'location_id' => $Location->id,
                'supplier_organisation_id' => $SupplierInvoice->supplier_organization_id,
                'supplier_contact_id' => $SupplierInvoice->supplier_contact_id,
                'purchase_order_invoice_status_id' => $SupplierInvoice->purchaseOrderStatusOption ? PurchaseOrderStatuses::where('name', str_replace("'","",str_replace('"','',$SupplierInvoice->purchaseOrderStatusOption->description)))->first()->id : PurchaseOrderStatuses::where('name', "-")->first()->id,
                'assigned_user_id' => 1,
                'currency_id' => $currency,
                'date' => $SupplierInvoice->invoice_date,
                'subject' => str_replace("'","",str_replace('"','',$SupplierInvoice->subject)),
                'due_date' => $SupplierInvoice->due_date,
                'subtotal_amount' => $SupplierInvoice->subtotal_amount,
                'sales_tax_percentage' => $SupplierInvoice->sales_tax_percentage,
                'total_amount' => $SupplierInvoice->total_amount,
                'description' => str_replace("'","",str_replace('"','',$SupplierInvoice->description)),
                'number' => str_replace("'","",str_replace('"','',$SupplierInvoice->invoice_number)),
                'tenant_id' => 1,
            ]);
            $progress->advance();
            unset($SupplierInvoice);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        info('Finished Purchases Migration');
    }
}

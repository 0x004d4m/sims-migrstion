<?php

namespace App\Console\Commands;


use App\Models\Sims_crm_db\{
    Invoice,
    Opportunity,
    Quote,
    SalesOrder,
};
use App\Models\Sims_new\{
    Currencies,
    Locations,
    Opportunities,
    OpportunitySources,
    Quotes,
    QuoteStages,
    SalesOrderInvoices,
    SalesOrderInvoiceStatuses,
    SalesOrders,
    SalesOrderStatuses,
    SalesStages,
};
use Illuminate\Console\Command;
use function Laravel\Prompts\info;
use function Laravel\Prompts\progress;

class MigrateSales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sims:migrate-sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate sales from old to new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        info('Starting Sale Orders Migration');


        $progress = progress(label: 'Migrating Opportunities', steps: Opportunity::count());
        $Opportunities = Opportunity::get();
        $progress->start();
        foreach ($Opportunities as $Opportunity) {
            if ($Opportunity->opportunitySourceOption) {
                if (OpportunitySources::where('name', str_replace("'","",str_replace('"','',$Opportunity->opportunitySourceOption->description)))->count() == 0) {
                    OpportunitySources::create([
                        'name' => str_replace("'","",str_replace('"','',$Opportunity->opportunitySourceOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (OpportunitySources::where('name', "-")->count() == 0) {
                    OpportunitySources::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            if ($Opportunity->salesStageOption) {
                if (SalesStages::where('name', str_replace("'","",str_replace('"','',$Opportunity->salesStageOption->description)))->count() == 0) {
                    SalesStages::create([
                        'name' => str_replace("'","",str_replace('"','',$Opportunity->salesStageOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (SalesStages::where('name', "-")->count() == 0) {
                    SalesStages::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $Opportunity->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$Opportunity->currency->currency_code)))->first()->id) : 1;
            $country = $Opportunity->contact ? ($Opportunity->contact->person ? ($Opportunity->contact->person->addressDetail ? $Opportunity->contact->person->addressDetail->country_id : 1) : 1) : 1;
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
            Opportunities::create([
                'id' => $Opportunity->id,
                'tenant_id' => 1,
                'name' => str_replace("'","",str_replace('"','',$Opportunity->name)),
                'probability' => str_replace("'","",str_replace('"','',$Opportunity->probability)),
                'amount' => $Opportunity->amount,
                'expected_close_date' => $Opportunity->expected_close_date,
                'campaign' => $Opportunity->campaign ? str_replace("'","",str_replace('"','',$Opportunity->campaign->name)) : null,
                'weighted_revenue' => $Opportunity->weighted_revenue,
                'description' => str_replace("'","",str_replace('"','',$Opportunity->description)),
                'contact_id' => $Opportunity->contact_id,
                'organisation_id' => $Opportunity->organization_id,
                'location_id' => $Location->id,
                'assigned_user_id' => 1,
                'opportunity_source_id' => $Opportunity->opportunitySourceOption ? OpportunitySources::where('name', str_replace("'","",str_replace('"','',$Opportunity->opportunitySourceOption->description)))->first()->id : OpportunitySources::where('name', "-")->first()->id,
                'sales_stage_id' => $Opportunity->salesStageOption ? SalesStages::where('name', str_replace("'","",str_replace('"','',$Opportunity->salesStageOption->description)))->first()->id : SalesStages::where('name', "-")->first()->id,
                'campaign_id' => $Opportunity->campaign ? $Opportunity->campaign->id : null,
                'currency_id' => $Opportunity->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$Opportunity->currency->currency_code)))->first()->id) : null,
            ]);
            $progress->advance();
            unset($Opportunity);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();
        unset($Opportunities);


        $progress = progress(label: 'Migrating Quotes', steps: Quote::count());
        $progress->start();
        foreach (Quote::get() as $Quote) {
            if ($Quote->quoteStageOption) {
                if (QuoteStages::where('name', str_replace("'","",str_replace('"','',$Quote->quoteStageOption->description)))->count() == 0) {
                    QuoteStages::create([
                        'name' => str_replace("'","",str_replace('"','',$Quote->quoteStageOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (QuoteStages::where('name', "-")->count() == 0) {
                    QuoteStages::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $Quote->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$Quote->currency->currency_code)))->first()->id) : 1;
            $country = $Quote->contact ? ($Quote->contact->person ? ($Quote->contact->person->addressDetail ? $Quote->contact->person->addressDetail->country_id : 1) : 1) : 1;
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
            Quotes::create([
                'id' => $Quote->id,
                'tenant_id' => 1,
                'location_id' => $Location->id,
                'quote_stage_id' => $Quote->quoteStageOption ? QuoteStages::where('name', str_replace("'","",str_replace('"','',$Quote->quoteStageOption->description)))->first()->id : QuoteStages::where('name', "-")->first()->id,
                'assigned_user_id' => 1,
                'currency_id' => $currency,
                'number' => str_replace("'","",str_replace('"','',$Quote->number)),
                'subject' => str_replace("'","",str_replace('"','',$Quote->subject)),
                'expiry_date' => $Quote->expiry_date,
                'sales_order' => null,
                'subtotal_amount' => $Quote->subtotal_amount,
                'sales_tax_percentage' => $Quote->sales_tax_percentage,
                'total_amount' => $Quote->total_amount,
                'tax_amount' => $Quote->media_tax_percentage,
                'description' => str_replace("'","",str_replace('"','',$Quote->description)),
                'opportunity_id' => $Quote->opportunity_id,
                'organisation_id' => $Quote->organization_id,
                'contact_id' => $Quote->contact_id,
            ]);
            $progress->advance();
            unset($Quote);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Sales Orders', steps: SalesOrder::count());
        $progress->start();
        foreach (SalesOrder::get() as $SalesOrder) {
            if ($SalesOrder->salesOrderStatusOption) {
                if (SalesOrderStatuses::where('name', str_replace("'","",str_replace('"','',$SalesOrder->salesOrderStatusOption->description)))->count() == 0) {
                    SalesOrderStatuses::create([
                        'name' => str_replace("'","",str_replace('"','',$SalesOrder->salesOrderStatusOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (SalesOrderStatuses::where('name', "-")->count() == 0) {
                    SalesOrderStatuses::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $SalesOrder->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$SalesOrder->currency->currency_code)))->first()->id) : 1;
            $country = $SalesOrder->contact ? ($SalesOrder->contact->person ? ($SalesOrder->contact->person->addressDetail ? $SalesOrder->contact->person->addressDetail->country_id : 1) : 1) : 1;
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
            SalesOrders::create([
                'id' => $SalesOrder->id,
                'tenant_id' => 1,
                'location_id' => $Location->id,
                'quote_id' => $Location->quote_id,
                'sales_order_status_id' => $SalesOrder->salesOrderStatusOption ? SalesOrderStatuses::where('name', str_replace("'","",str_replace('"','',$SalesOrder->salesOrderStatusOption->description)))->first()->id : SalesOrderStatuses::where('name', "-")->first()->id,
                'assigned_user_id' => 1,
                'currency_id' => $currency,
                'opportunity_id' => $SalesOrder->opportunity_id,
                'organisation_id' => $SalesOrder->organization_id,
                'subject' => str_replace("'","",str_replace('"','',$SalesOrder->subject)),
                'due_date' => $SalesOrder->due_date,
                'subtotal_amount' => $SalesOrder->subtotal_amount,
                'sales_tax_percentage' => $SalesOrder->sales_tax_percentage,
                'total_amount' => $SalesOrder->total_amount,
                'tax_amount' => $SalesOrder->media_tax_percentage,
                'description' => str_replace("'","",str_replace('"','',$SalesOrder->description)),
                'contact_id' => $SalesOrder->contact_id,
            ]);
            $progress->advance();
            unset($SalesOrder);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Invoices', steps: Invoice::count());
        $progress->start();
        foreach (Invoice::get() as $Invoice) {
            if ($Invoice->invoiceStatusOption) {
                if (SalesOrderInvoiceStatuses::where('name', str_replace("'","",str_replace('"','',$Invoice->invoiceStatusOption->description)))->count() == 0) {
                    SalesOrderInvoiceStatuses::create([
                        'name' => str_replace("'","",str_replace('"','',$Invoice->invoiceStatusOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (SalesOrderInvoiceStatuses::where('name', "-")->count() == 0) {
                    SalesOrderInvoiceStatuses::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $Invoice->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$Invoice->currency->currency_code)))->first()->id) : 1;
            $country = $Invoice->contact ? ($Invoice->contact->person ? ($Invoice->contact->person->addressDetail ? $Invoice->contact->person->addressDetail->country_id : 1) : 1) : 1;
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
            SalesOrderInvoices::create([
                'id' => $Invoice->id,
                'sales_order_id' => $Invoice->sales_order_id,
                'location_id' => $Location->id,
                'organisation_id' => $Invoice->organization_id,
                'sales_order_invoice_status_id' => $Invoice->invoiceStatusOption ? SalesOrderInvoiceStatuses::where('name', str_replace("'","",str_replace('"','',$Invoice->invoiceStatusOption->description)))->first()->id : SalesOrderInvoiceStatuses::where('name', "-")->first()->id,
                'assigned_user_id' => 1,
                'currency_id' => $currency,
                'date' => $Invoice->invoice_date,
                'subject' => str_replace("'","",str_replace('"','',$Invoice->subject)),
                'due_date' => $Invoice->due_date,
                'subtotal_amount' => $Invoice->subtotal_amount,
                'sales_tax_percentage' => $Invoice->sales_tax_percentage,
                'total_amount' => $Invoice->total_amount,
                'description' => str_replace("'","",str_replace('"','',$Invoice->description)),
                'contact_id' => $Invoice->contact_id,
                'number' => str_replace("'","",str_replace('"','',$Invoice->number)),
                'tenant_id' => 1,
                'tax_amount' => $Invoice->media_tax_percentage,
            ]);
            $progress->advance();
            unset($Invoice);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        info('Finished Sale Orders Migration');
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Sims_crm_db\{
    ExpensesContact,
    ExpensesPaymentVoucher,
    ExpensesVoucher,
};
use App\Models\Sims_new\{
    Currencies,
    ExpensesAccountAddresses,
    ExpensesAccounts,
    ExpensesCategories,
    ExpensesModes,
    ExpensesPaymentVouchers,
    ExpensesVouchers,
    Locations,
    PaymentMethods,
    PurchaseOrderInvoiceStatuses,
};
use Illuminate\Console\Command;
use function Laravel\Prompts\info;
use function Laravel\Prompts\progress;

class MigrateExpenses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sims:migrate-expenses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate expenses from old to new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        info('Starting Expenses Migration');

        $progress = progress(label: 'Migrating Expenses Accounts', steps: ExpensesContact::count());
        $progress->start();
        foreach (ExpensesContact::get() as $ExpensesContact) {
            if ($ExpensesContact->expensesCategory) {
                if (ExpensesCategories::where('name', $ExpensesContact->expensesCategory->description)->count() == 0) {
                    ExpensesCategories::create([
                        'name' => $ExpensesContact->expensesCategory->description,
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (ExpensesCategories::where('name', "-")->count() == 0) {
                    ExpensesCategories::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            if ($ExpensesContact->expensesMode) {
                if (ExpensesModes::where('name', $ExpensesContact->expensesMode->description)->count() == 0) {
                    ExpensesModes::create([
                        'name' => $ExpensesContact->expensesMode->description,
                    ]);
                }
            } else {
                if (ExpensesModes::where('name', "-")->count() == 0) {
                    ExpensesModes::create([
                        'name' => "-",
                    ]);
                }
            }
            $currency = $ExpensesContact->currency ? (Currencies::where('code', $ExpensesContact->currency->currency_code)->first()->id) : 1;
            $country = $ExpensesContact->addressDetail ? $ExpensesContact->addressDetail->country_id : 1;
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
            ExpensesAccounts::create([
                'id' => $ExpensesContact->id,
                'location_id' => $Location->id,
                'expenses_category_id' => $ExpensesContact->expensesCategory ? ExpensesCategories::where('name', $ExpensesContact->expensesCategory->description)->first()->id : ExpensesCategories::where('name', "-")->first()->id,
                'expenses_mode_id' => $ExpensesContact->expensesMode ? ExpensesModes::where('name', $ExpensesContact->expensesMode->description)->first()->id : ExpensesModes::where('name', "-")->first()->id,
                'assigned_user_id' => 1,
                'tenant_id' => 1,
                'organisation_id' => null,
                'first_name' => $ExpensesContact->first_name,
                'last_name' => $ExpensesContact->last_name,
                'description' => $ExpensesContact->description,
                'tax_free' => $ExpensesContact->is_tax_free,
                'primary_email' => $ExpensesContact->reachDetail ? $ExpensesContact->reachDetail->email : null,
                'primary_mobile' => $ExpensesContact->reachDetail ? $ExpensesContact->reachDetail->mobile : null,
                'primary_phone' => $ExpensesContact->reachDetail ? $ExpensesContact->reachDetail->phone : null,
                'primary_fax' => $ExpensesContact->reachDetail ? $ExpensesContact->reachDetail->fax : null,
                'website' => $ExpensesContact->reachDetail ? $ExpensesContact->reachDetail->website : null,
                'brand_name' => $ExpensesContact->brand_name,
                'tax_number' => $ExpensesContact->tax_number,
                'organization_name' => $ExpensesContact->organization_name,
                'starting_balance' => $ExpensesContact->starting_balance,
                'starting_balance_date' => $ExpensesContact->starting_balance_date,
                'currency_id' => $currency,
                'account_number' => $ExpensesContact->account_number,
            ]);
            if ($ExpensesContact->addressDetail) {
                ExpensesAccountAddresses::create([
                    'billing_country_id' => $ExpensesContact->addressDetail->country_id,
                    'billing_state' => $ExpensesContact->addressDetail->state,
                    'billing_postal_code' => $ExpensesContact->addressDetail->postal_code,
                    'billing_address' => $ExpensesContact->addressDetail->address,
                    'billing_city' => $ExpensesContact->addressDetail->city,
                    'billing_p_o_box' => $ExpensesContact->addressDetail->post_office_box,
                    'expenses_account_id' => $ExpensesContact->id,
                ]);
            }
            $progress->advance();
            unset($ExpensesContact);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Expenses Vouchers', steps: ExpensesVoucher::count());
        $progress->start();
        foreach (ExpensesVoucher::get() as $ExpensesVoucher) {
            if ($ExpensesVoucher->supplierInvoiceStatusOption) {
                if (PurchaseOrderInvoiceStatuses::where('name', $ExpensesVoucher->supplierInvoiceStatusOption->description)->count() == 0) {
                    PurchaseOrderInvoiceStatuses::create([
                        'name' => $ExpensesVoucher->supplierInvoiceStatusOption->description,
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (PurchaseOrderInvoiceStatuses::where('name', "-")->count() == 0) {
                    PurchaseOrderInvoiceStatuses::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $ExpensesVoucher->currency ? (Currencies::where('code', $ExpensesVoucher->currency->currency_code)->first()->id) : 1;
            $country = $ExpensesVoucher->addressDetail ? $ExpensesVoucher->addressDetail->country_id : 1;
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
            ExpensesVouchers::create([
                'id' => $ExpensesVoucher->id,
                'location_id' => $Location->id,
                'supplier_invoice_status_id' => $ExpensesVoucher->supplierInvoiceStatusOption ? PurchaseOrderInvoiceStatuses::where('name', $ExpensesVoucher->supplierInvoiceStatusOption->description)->count() : PurchaseOrderInvoiceStatuses::where('name', "-")->count(),
                'assigned_user_id' => 1,
                'currency_id' => $currency,
                'expenses_contact_id' => $ExpensesVoucher->expensesContact ? $ExpensesVoucher->expensesContact->id : null,
                'expenses_organisation_id' => $ExpensesVoucher->expensesOrganisation ? $ExpensesVoucher->expensesOrganisation->id : null,
                'subject' => $ExpensesVoucher->subject,
                'number' => $ExpensesVoucher->number,
                'date' => $ExpensesVoucher->invoice_date,
                'subtotal_amount' => $ExpensesVoucher->subtotal_amount,
                'sales_tax_percentage' => $ExpensesVoucher->sales_tax_percentage,
                'total_amount' => $ExpensesVoucher->total_amount,
                'description' => $ExpensesVoucher->description,
                'organization_name' => $ExpensesVoucher->expensesOrganisation ? $ExpensesVoucher->expensesOrganisation->brand_name : null,
                'tenant_id' => 1,
                'type' => $ExpensesVoucher->is_cash_expenses == 1 ? 'Credit' : 'Debit',
            ]);

            $progress->advance();
            unset($ExpensesVoucher);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Expenses Payment Vouchers', steps: ExpensesPaymentVoucher::count());
        $progress->start();
        foreach (ExpensesPaymentVoucher::get() as $ExpensesPaymentVoucher) {
            $currency = $ExpensesPaymentVoucher->currency ? (Currencies::where('code', $ExpensesPaymentVoucher->currency->currency_code)->first()->id) : 1;
            $country = $ExpensesPaymentVoucher->expensesInvoice ? ($ExpensesPaymentVoucher->expensesInvoice->addressDetail ? $ExpensesPaymentVoucher->expensesInvoice->addressDetail->country_id : 1) : 1;
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
            if ($ExpensesPaymentVoucher->paymentMethod) {
                if (PaymentMethods::where('name', $ExpensesPaymentVoucher->paymentMethod->name)->count() == 0) {
                    PaymentMethods::create([
                        'name' => $ExpensesPaymentVoucher->paymentMethod->name,
                    ]);
                }
            } else {
                if (PaymentMethods::where('name', "-")->count() == 0) {
                    PaymentMethods::create([
                        'name' => "-",
                    ]);
                }
            }
            ExpensesPaymentVouchers::create([
                'id' => $ExpensesPaymentVoucher->id,
                'location_id' => $Location->id,
                'assigned_user_id' => 1,
                'expenses_contact_id' => $ExpensesPaymentVoucher->expenses_contact_id,
                'expenses_organisation_id' => $ExpensesPaymentVoucher->expenses_organization_id,
                'expenses_voucher_id' => $ExpensesPaymentVoucher->expenses_invoice_id,
                'currency_id' => $currency,
                'payment_method_id' => $ExpensesPaymentVoucher->paymentMethod ? PaymentMethods::where('name', $ExpensesPaymentVoucher->paymentMethod->name)->first()->id : PaymentMethods::where('name', "-")->first()->id,
                'subject' => $ExpensesPaymentVoucher->subject,
                'number' => $ExpensesPaymentVoucher->number,
                'payment_date' => $ExpensesPaymentVoucher->payment_date,
                'description' => $ExpensesPaymentVoucher->description,
                'cash_amount' => $ExpensesPaymentVoucher->cash_amount,
                'total_amount' => $ExpensesPaymentVoucher->total_amount,
                'organization_name' => $ExpensesPaymentVoucher->expensesOrganization? $ExpensesPaymentVoucher->expensesOrganization->brand_name : null,
                'tenant_id' => 1,
                'type' => $ExpensesPaymentVoucher->expensesInvoice? ($ExpensesPaymentVoucher->expensesInvoice->is_cash_expenses == 1 ? 'Credit' : 'Debit'): 'Debit',
            ]);

            $progress->advance();
            unset($ExpensesPaymentVoucher);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        info('Finished Expenses Migration');
    }
}

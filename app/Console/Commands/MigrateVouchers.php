<?php

namespace App\Console\Commands;

use App\Models\Sims_crm_db\{
    PaymentVoucherCheckPayment,
    ReceiptVoucherCheckPayment
};
use App\Models\Sims_new\{
    Currencies,
    Locations,
    Vouchers
};
use Illuminate\Console\Command;
use function Laravel\Prompts\info;
use function Laravel\Prompts\progress;

class MigrateVouchers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sims:migrate-vouchers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate vouchers from old to new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        info('Starting Vouchers Migration');


        $progress = progress(label: 'Migrating Vouchers From Payment Voucher Check Payments', steps: PaymentVoucherCheckPayment::count());
        $progress->start();
        foreach (PaymentVoucherCheckPayment::get() as $PaymentVoucherCheckPayment) {
            $currency = $PaymentVoucherCheckPayment->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$PaymentVoucherCheckPayment->currency->currency_code)))->first()->id) : 1;
            $country = $PaymentVoucherCheckPayment->paymentVoucher ? ($PaymentVoucherCheckPayment->paymentVoucher->supplierContact ? ($PaymentVoucherCheckPayment->paymentVoucher->supplierContact->addressDetail ? ($PaymentVoucherCheckPayment->paymentVoucher->supplierContact->addressDetail->country_id) : 1) : 1) : 1;
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
            Vouchers::create([
                'type' => 'Debit',
                'location_id' => $Location->id,
                'sales_order_invoices_id' => null,
                'purchase_order_invoices_id' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->supplier_invoice_id : null,
                'assigned_user_id' => 1,
                'organisation_id' => null,
                'contact_id' => null,
                'supplier_organisation_id' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->supplier_organization_id : null,
                'supplier_contact_id' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->supplier_contact_id : null,
                'currency_id' => $currency,
                'payment_method_id' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->payment_method_id : null,
                'subject' => $PaymentVoucherCheckPayment->paymentVoucher ? str_replace("'","",str_replace('"','',$PaymentVoucherCheckPayment->paymentVoucher->subject)) : null,
                'number' => $PaymentVoucherCheckPayment->paymentVoucher ? str_replace("'","",str_replace('"','',$PaymentVoucherCheckPayment->paymentVoucher->number)) : null,
                'date_of_receipt' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->payment_date : null,
                'description' => $PaymentVoucherCheckPayment->paymentVoucher ? str_replace("'","",str_replace('"','',$PaymentVoucherCheckPayment->paymentVoucher->description)) : null,
                'cash_amount' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->cash_amount : null,
                'total_amount' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->total_amount : null,
                'tenant_id' => 1,
            ]);
            $progress->advance();
            unset($PaymentVoucherCheckPayment);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();

        $progress = progress(label: 'Migrating Vouchers From Receipt Voucher Check Payments', steps: ReceiptVoucherCheckPayment::count());
        $progress->start();
        foreach (ReceiptVoucherCheckPayment::get() as $ReceiptVoucherCheckPayment) {
            $currency = $ReceiptVoucherCheckPayment->receiptVoucher ? ($ReceiptVoucherCheckPayment->receiptVoucher->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$ReceiptVoucherCheckPayment->receiptVoucher->currency->currency_code)))->first()->id) : 1) : 1;
            $country = $ReceiptVoucherCheckPayment->receiptVoucher ? ($ReceiptVoucherCheckPayment->receiptVoucher->contact ? ($ReceiptVoucherCheckPayment->receiptVoucher->contact->person ? ($ReceiptVoucherCheckPayment->receiptVoucher->contact->person->addressDetail ? str_replace("'","",str_replace('"','',$ReceiptVoucherCheckPayment->receiptVoucher->contact->person->addressDetail->country_id)) : 1) : 1) : 1) : 1;
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
            Vouchers::create([
                'type' => 'Credit',
                'location_id' => $Location->id,
                'sales_order_invoices_id' => $ReceiptVoucherCheckPayment->receiptVoucher? $ReceiptVoucherCheckPayment->receiptVoucher->invoice_id :null,
                'purchase_order_invoices_id' => null,
                'assigned_user_id' => 1,
                'organisation_id' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->organization_id : null,
                'contact_id' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->contact_id : null,
                'supplier_organisation_id' => null,
                'supplier_contact_id' => null,
                'currency_id' => $currency,
                'payment_method_id' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->payment_method_id : null,
                'subject' => $ReceiptVoucherCheckPayment->receiptVoucher ? str_replace("'","",str_replace('"','',$ReceiptVoucherCheckPayment->receiptVoucher->subject)) : null,
                'number' => $ReceiptVoucherCheckPayment->receiptVoucher ? str_replace("'","",str_replace('"','',$ReceiptVoucherCheckPayment->receiptVoucher->number)) : null,
                'date_of_receipt' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->date_of_receipt : null,
                'description' => $ReceiptVoucherCheckPayment->receiptVoucher ? str_replace("'","",str_replace('"','',$ReceiptVoucherCheckPayment->receiptVoucher->description)) : null,
                'cash_amount' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->cash_amount : null,
                'total_amount' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->total_amount : null,
                'tenant_id' => 1,
            ]);
            $progress->advance();
            unset($ReceiptVoucherCheckPayment);
            unset($currency);
            unset($country);
            unset($Location);
        }
        $progress->finish();


        info('Finished Vouchers Migration');
    }
}

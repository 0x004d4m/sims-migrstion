<?php

namespace App\Console\Commands;

use App\Models\Sims_crm_db\{
    PaymentVoucherCheckPayment,
    ReceiptVoucherCheckPayment
};
use App\Models\Sims_new\{
    Currencies,
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
            $currency = $PaymentVoucherCheckPayment->currency ? (Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'","",str_replace('"','',$PaymentVoucherCheckPayment->currency->currency_code)))))->first()->id) : 1;
            Vouchers::create([
                'type' => 'Debit',
                'location_id' => $PaymentVoucherCheckPayment->paymentVoucher ? ($PaymentVoucherCheckPayment->paymentVoucher->Document ? ($PaymentVoucherCheckPayment->paymentVoucher->Document->location_id) : null) : null,
                'sales_order_invoices_id' => null,
                'purchase_order_invoices_id' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->supplier_invoice_id : null,
                'assigned_user_id' => $PaymentVoucherCheckPayment->paymentVoucher ? ($PaymentVoucherCheckPayment->paymentVoucher->Document ? ($PaymentVoucherCheckPayment->paymentVoucher->Document->user_id??1) : 1) : 1,
                'organisation_id' => null,
                'contact_id' => null,
                'supplier_organisation_id' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->supplier_organization_id : null,
                'supplier_contact_id' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->supplier_contact_id : null,
                'currency_id' => $currency,
                'payment_method_id' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->payment_method_id : null,
                'subject' => $PaymentVoucherCheckPayment->paymentVoucher ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'","",str_replace('"','',$PaymentVoucherCheckPayment->paymentVoucher->subject)))) : null,
                'number' => $PaymentVoucherCheckPayment->paymentVoucher ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'","",str_replace('"','',$PaymentVoucherCheckPayment->paymentVoucher->number)))) : null,
                'date_of_receipt' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->payment_date : null,
                'description' => $PaymentVoucherCheckPayment->paymentVoucher ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'","",str_replace('"','',$PaymentVoucherCheckPayment->paymentVoucher->description)))) : null,
                'cash_amount' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->cash_amount : null,
                'total_amount' => $PaymentVoucherCheckPayment->paymentVoucher ? $PaymentVoucherCheckPayment->paymentVoucher->total_amount : null,
                'tenant_id' => 1,
                'u_id' => (Vouchers::count() + 1),
                'created_at' => $PaymentVoucherCheckPayment->paymentVoucher ? ($PaymentVoucherCheckPayment->paymentVoucher->Document ? ($PaymentVoucherCheckPayment->paymentVoucher->Document->create_time) : null) : null,
                'updated_at' => $PaymentVoucherCheckPayment->paymentVoucher ? ($PaymentVoucherCheckPayment->paymentVoucher->Document ? ($PaymentVoucherCheckPayment->paymentVoucher->Document->last_edit_time) : null) : null,
            ]);
            $progress->advance();
            unset($PaymentVoucherCheckPayment);
            unset($currency);
        }
        $progress->finish();

        $progress = progress(label: 'Migrating Vouchers From Receipt Voucher Check Payments', steps: ReceiptVoucherCheckPayment::count());
        $progress->start();
        foreach (ReceiptVoucherCheckPayment::get() as $ReceiptVoucherCheckPayment) {
            $currency = $ReceiptVoucherCheckPayment->receiptVoucher ? ($ReceiptVoucherCheckPayment->receiptVoucher->currency ? (Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'","",str_replace('"','',$ReceiptVoucherCheckPayment->receiptVoucher->currency->currency_code)))))->first()->id) : 1) : 1;
            Vouchers::create([
                'type' => 'Credit',
                'location_id' => $ReceiptVoucherCheckPayment->receiptVoucher ? ($ReceiptVoucherCheckPayment->receiptVoucher->Document ? ($ReceiptVoucherCheckPayment->receiptVoucher->Document->location_id) : null) : null,
                'sales_order_invoices_id' => $ReceiptVoucherCheckPayment->receiptVoucher? $ReceiptVoucherCheckPayment->receiptVoucher->invoice_id :null,
                'purchase_order_invoices_id' => null,
                'assigned_user_id' => $ReceiptVoucherCheckPayment->receiptVoucher ? ($ReceiptVoucherCheckPayment->receiptVoucher->Document ? ($ReceiptVoucherCheckPayment->receiptVoucher->Document->user_id??1) : 1) : 1,
                'organisation_id' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->organization_id : null,
                'contact_id' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->contact_id : null,
                'supplier_organisation_id' => null,
                'supplier_contact_id' => null,
                'currency_id' => $currency,
                'payment_method_id' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->payment_method_id : null,
                'subject' => $ReceiptVoucherCheckPayment->receiptVoucher ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'","",str_replace('"','',$ReceiptVoucherCheckPayment->receiptVoucher->subject)))) : null,
                'number' => $ReceiptVoucherCheckPayment->receiptVoucher ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'","",str_replace('"','',$ReceiptVoucherCheckPayment->receiptVoucher->number)))) : null,
                'date_of_receipt' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->date_of_receipt : null,
                'description' => $ReceiptVoucherCheckPayment->receiptVoucher ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'","",str_replace('"','',$ReceiptVoucherCheckPayment->receiptVoucher->description)))) : null,
                'cash_amount' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->cash_amount : null,
                'total_amount' => $ReceiptVoucherCheckPayment->receiptVoucher ? $ReceiptVoucherCheckPayment->receiptVoucher->total_amount : null,
                'tenant_id' => 1,
                'u_id' => (Vouchers::count() + 1),
                'created_at' => $ReceiptVoucherCheckPayment->receiptVoucher ? ($ReceiptVoucherCheckPayment->receiptVoucher->Document ? ($ReceiptVoucherCheckPayment->receiptVoucher->Document->create_time) : null) : null,
                'updated_at' => $ReceiptVoucherCheckPayment->receiptVoucher ? ($ReceiptVoucherCheckPayment->receiptVoucher->Document ? ($ReceiptVoucherCheckPayment->receiptVoucher->Document->last_edit_time) : null) : null,
            ]);
            $progress->advance();
            unset($ReceiptVoucherCheckPayment);
            unset($currency);
        }
        $progress->finish();


        info('Finished Vouchers Migration');
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Sims_crm_db\{
    ExpensesVoucherCustomItem,
    ExpensesVoucherProduct,
    Invoice,
    InvoiceCustomItem,
    InvoiceProduct,
    InvoiceService,
    Product,
    PurchaseOrderCustomItem,
    PurchaseOrderProduct,
    QuoteCustomItem,
    QuoteProduct,
    QuoteService,
    RequestForQuotationCustomItem,
    RequestForQuotationProduct,
    SalesOrderCustomItem,
    SalesOrderProduct,
    SalesOrderService,
    Service,
    SupplierInvoiceCustomItem,
    SupplierInvoiceProduct,
};
use Illuminate\Console\Command;
use App\Models\Sims_new\{
    Currencies,
    CustomItems,
    InventoryProductCategories,
    InventoryProducts,
    InventoryServiceCategories,
    InventoryServices,
    InventoryServiceUsageUnits,
    Locations,
    ObjectInventories,
    UsageUnits,
};
use function Laravel\Prompts\info;
use function Laravel\Prompts\progress;

class MigrateInventories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sims:migrate-inventories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate inventories from old to new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        info('Starting Inventories Migration');


        $progress = progress(label: 'Migrating Products', steps: Product::count());
        $progress->start();
        foreach (Product::get() as $Product) {
            if ($Product->productCategoryOption) {
                if (InventoryProductCategories::where('name', str_replace("'","",str_replace('"','',$Product->productCategoryOption->description)))->count() == 0) {
                    InventoryProductCategories::create([
                        'name' => str_replace("'","",str_replace('"','',$Product->productCategoryOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (InventoryProductCategories::where('name', "-")->count() == 0) {
                    InventoryProductCategories::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            if ($Product->usageUnitOption) {
                if (UsageUnits::where('name', str_replace("'","",str_replace('"','',$Product->usageUnitOption->description)))->count() == 0) {
                    UsageUnits::create([
                        'name' => str_replace("'","",str_replace('"','',$Product->usageUnitOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (UsageUnits::where('name', "-")->count() == 0) {
                    UsageUnits::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $Product->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$Product->currency->currency_code)))->first()->id) : 1;
            $country = $Product->supplierContact ? ($Product->supplierContact->addressDetail ? $Product->supplierContact->addressDetail->country_id : 1) : 1;
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
            InventoryProducts::create([
                'id' => $Product->id,
                'location_id' => $Location->id,
                'inventory_product_category_id' => $Product->productCategoryOption ? (InventoryProductCategories::where('name', str_replace("'","",str_replace('"','',$Product->productCategoryOption->description)))->first()->id) : (InventoryProductCategories::where('name', "-")->first()->id),
                'usage_unit_id' => $Product->usageUnitOption ? (UsageUnits::where('name', str_replace("'","",str_replace('"','',$Product->usageUnitOption->description)))->first()->id) : (UsageUnits::where('name', "-")->first()->id),
                'assigned_user_id' => 1,
                'currency_id' => $currency,
                'number' => str_replace("'","",str_replace('"','',$Product->number)),
                'manufacturer' => str_replace("'","",str_replace('"','',$Product->manufacturer)),
                'active' => $Product->is_active,
                'expiry_date' => $Product->expiry_date,
                'unit_price' => $Product->unit_price??0,
                'name' => str_replace("'","",str_replace('"','',$Product->name)),
                'supplier_part_number' => $Product->supplier_part_number,
                'manufacturer_part_number' => $Product->manufacturer_part_number,
                'website' => str_replace("'","",str_replace('"','',$Product->website)),
                'quantity_in_stock' => $Product->quantity_in_stock,
                'purchase_cost' => $Product->purchase_cost,
                'description' => str_replace("'","",str_replace('"','',$Product->description)),
                'tenant_id' => 1,
                'supplier_organisation_id' => $Product->supplier_organization_id,
                'supplier_contact_id' => $Product->supplier_contact_id,
            ]);

            $progress->advance();
            unset($Product);
            unset($Location);
            unset($currency);
            unset($country);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Invoice Products', steps: InvoiceProduct::count());
        $progress->start();
        foreach (InvoiceProduct::get() as $InvoiceProduct) {
            ObjectInventories::create([
                'object_type' => object_inventories_object_type("CustomerInvoices"),
                'object_id' => $InvoiceProduct->invoice_id,
                'inventory_type' => object_inventories_inventory_type("InventoryProducts"),
                'inventory_id' => $InvoiceProduct->product_id,
                'quantity' => $InvoiceProduct->quantity,
                'unit_price' => $InvoiceProduct->unit_price,
                'total_price' => null,
                'description' => str_replace("'","",str_replace('"','',$InvoiceProduct->description)),
                'tenant_id' => 1,
                'tax_rate' => null,
                'sub_total_amount' => null,
                'tax_amount' => null,
            ]);
            $progress->advance();
            unset($InvoiceProduct);
        }
        $progress->finish();


        // $progress = progress(label: 'Migrating Expenses Voucher Products', steps: ExpensesVoucherProduct::count());
        // $progress->start();
        // foreach (ExpensesVoucherProduct::get() as $ExpensesVoucherProduct) {
        //     ObjectInventories::create([
        //         'object_type' => object_inventories_object_type("ExpensesVouchers"),
        //         'object_id' => $ExpensesVoucherProduct->expenses_voucher_id,
        //         'inventory_type' => object_inventories_inventory_type("InventoryProducts"),
        //         'inventory_id' => $ExpensesVoucherProduct->product_id,
        //         'quantity' => $ExpensesVoucherProduct->quantity,
        //         'unit_price' => $ExpensesVoucherProduct->unit_price,
        //         'total_price' => null,
        //         'description' => $ExpensesVoucherProduct->description,
        //         'tenant_id' => 1,
        //         'tax_rate' => null,
        //         'sub_total_amount' => null,
        //         'tax_amount' => null,
        //     ]);
        //     $progress->advance();
        //     unset($ExpensesVoucherProduct);
        // }
        // $progress->finish();


        // $progress = progress(label: 'Migrating Purchase Order Products', steps: PurchaseOrderProduct::count());
        // $progress->start();
        // foreach (PurchaseOrderProduct::get() as $PurchaseOrderProduct) {
        //     ObjectInventories::create([
        //         'object_type' => object_inventories_object_type("PurchaseOrders"),
        //         'object_id' => $PurchaseOrderProduct->purchase_order_id,
        //         'inventory_type' => object_inventories_inventory_type("InventoryProducts"),
        //         'inventory_id' => $PurchaseOrderProduct->product_id,
        //         'quantity' => $PurchaseOrderProduct->quantity,
        //         'unit_price' => $PurchaseOrderProduct->unit_price,
        //         'total_price' => null,
        //         'description' => $PurchaseOrderProduct->description,
        //         'tenant_id' => 1,
        //         'tax_rate' => null,
        //         'sub_total_amount' => null,
        //         'tax_amount' => null,
        //     ]);
        //     $progress->advance();
        //     unset($PurchaseOrderProduct);
        // }
        // $progress->finish();


        $progress = progress(label: 'Migrating Quotes Products', steps: QuoteProduct::count());
        $progress->start();
        foreach (QuoteProduct::get() as $QuoteProduct) {
            ObjectInventories::create([
                'object_type' => object_inventories_object_type("Quotes"),
                'object_id' => $QuoteProduct->quote_id,
                'inventory_type' => object_inventories_inventory_type("InventoryProducts"),
                'inventory_id' => $QuoteProduct->product_id,
                'quantity' => $QuoteProduct->quantity,
                'unit_price' => $QuoteProduct->unit_price,
                'total_price' => null,
                'description' => str_replace("'","",str_replace('"','',$QuoteProduct->description)),
                'tenant_id' => 1,
                'tax_rate' => null,
                'sub_total_amount' => null,
                'tax_amount' => null,
            ]);
            $progress->advance();
            unset($QuoteProduct);
        }
        $progress->finish();


        // $progress = progress(label: 'Migrating Request For Quotation Products', steps: RequestForQuotationProduct::count());
        // $progress->start();
        // foreach (RequestForQuotationProduct::get() as $RequestForQuotationProduct) {
        //     ObjectInventories::create([
        //         'object_type' => object_inventories_object_type("RequestForQuotations"),
        //         'object_id' => $RequestForQuotationProduct->request_for_quotation_id,
        //         'inventory_type' => object_inventories_inventory_type("InventoryProducts"),
        //         'inventory_id' => $RequestForQuotationProduct->product_id,
        //         'quantity' => $RequestForQuotationProduct->quantity,
        //         'unit_price' => $RequestForQuotationProduct->unitPrice,
        //         'total_price' => null,
        //         'description' => $RequestForQuotationProduct->description,
        //         'tenant_id' => 1,
        //         'tax_rate' => null,
        //         'sub_total_amount' => null,
        //         'tax_amount' => null,
        //     ]);
        //     $progress->advance();
        //     unset($RequestForQuotationProduct);
        // }
        // $progress->finish();


        $progress = progress(label: 'Migrating Sales Order Products', steps: SalesOrderProduct::count());
        $progress->start();
        foreach (SalesOrderProduct::get() as $SalesOrderProduct) {
            ObjectInventories::create([
                'object_type' => object_inventories_object_type("SalesOrders"),
                'object_id' => $SalesOrderProduct->sales_order_id,
                'inventory_type' => object_inventories_inventory_type("InventoryProducts"),
                'inventory_id' => $SalesOrderProduct->product_id,
                'quantity' => $SalesOrderProduct->quantity,
                'unit_price' => $SalesOrderProduct->unit_price,
                'total_price' => null,
                'description' => str_replace("'","",str_replace('"','',$SalesOrderProduct->description)),
                'tenant_id' => 1,
                'tax_rate' => null,
                'sub_total_amount' => null,
                'tax_amount' => null,
            ]);
            $progress->advance();
            unset($SalesOrderProduct);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Sales Order Products', steps: SupplierInvoiceProduct::count());
        $progress->start();
        foreach (SupplierInvoiceProduct::get() as $SupplierInvoiceProduct) {
            ObjectInventories::create([
                'object_type' => object_inventories_object_type("SupplierInvoices"),
                'object_id' => $SupplierInvoiceProduct->supplier_invoice_id,
                'inventory_type' => object_inventories_inventory_type("InventoryProducts"),
                'inventory_id' => $SupplierInvoiceProduct->product_id,
                'quantity' => $SupplierInvoiceProduct->quantity,
                'unit_price' => $SupplierInvoiceProduct->unit_price,
                'total_price' => null,
                'description' => str_replace("'","",str_replace('"','',$SupplierInvoiceProduct->description)),
                'tenant_id' => 1,
                'tax_rate' => null,
                'sub_total_amount' => null,
                'tax_amount' => null,
            ]);
            $progress->advance();
            unset($SupplierInvoiceProduct);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Services', steps: Service::count());
        $progress->start();
        foreach (Service::get() as $Service) {
            if ($Service->serviceCategoryOption) {
                if (InventoryServiceCategories::where('name', str_replace("'","",str_replace('"','',$Service->serviceCategoryOption->description)))->count() == 0) {
                    InventoryServiceCategories::create([
                        'name' => str_replace("'","",str_replace('"','',$Service->serviceCategoryOption->description)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (InventoryServiceCategories::where('name', "-")->count() == 0) {
                    InventoryServiceCategories::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            if ($Service->serviceUsageUnit) {
                if (InventoryServiceUsageUnits::where('name', str_replace("'","",str_replace('"','',$Service->serviceUsageUnit->name)))->count() == 0) {
                    InventoryServiceUsageUnits::create([
                        'name' => str_replace("'","",str_replace('"','',$Service->serviceUsageUnit->name)),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (InventoryServiceUsageUnits::where('name', "-")->count() == 0) {
                    InventoryServiceUsageUnits::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $Service->currency ? (Currencies::where('code', str_replace("'","",str_replace('"','',$Service->currency->currency_code)))->first()->id) : 1;

            InventoryServices::create([
                'id' => $Service->id,
                'location_id' => null,
                'inventory_service_category_id' => $Service->serviceCategoryOption ? (InventoryServiceCategories::where('name', str_replace("'","",str_replace('"','',$Service->serviceCategoryOption->description)))->first()->id) : (InventoryServiceCategories::where('name', "-")->first()->id),
                'usage_unit_id' => $Service->serviceUsageUnit ? (InventoryServiceUsageUnits::where('name', str_replace("'","",str_replace('"','',$Service->serviceUsageUnit->name)))->first()->id) : (InventoryServiceUsageUnits::where('name', "-")->first()->id),
                'assigned_user_id' => 1,
                'currency_id' => $currency,
                'number' => $Service->number,
                'number_of_units' => $Service->number_of_units,
                'active' => str_replace("'","",str_replace('"','',$Service->is_active)),
                'name' => str_replace("'","",str_replace('"','',$Service->name)),
                'website' => str_replace("'","",str_replace('"','',$Service->website)),
                'purchase_cost' => $Service->purchase_cost,
                'description' => str_replace("'","",str_replace('"','',$Service->description)),
                'tenant_id' => 1,
                'unit_price' => $Service->service_price??0,
            ]);

            $progress->advance();
            unset($Product);
            unset($Location);
            unset($currency);
            unset($country);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Quote Services', steps: QuoteService::count());
        $progress->start();
        foreach (QuoteService::get() as $QuoteService) {
            ObjectInventories::create([
                'object_type' => object_inventories_object_type("Quotes"),
                'object_id' => $QuoteService->quote_id,
                'inventory_type' => object_inventories_inventory_type("InventoryServices"),
                'inventory_id' => $QuoteService->service_id,
                'quantity' => $QuoteService->quantity,
                'unit_price' => $QuoteService->unit_price??0,
                'total_price' => null,
                'description' => str_replace("'","",str_replace('"','',$QuoteService->description)),
                'tenant_id' => 1,
                'tax_rate' => null,
                'sub_total_amount' => null,
                'tax_amount' => null,
            ]);
            $progress->advance();
            unset($QuoteService);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Invoice Services', steps: InvoiceService::count());
        $progress->start();
        foreach (InvoiceService::get() as $InvoiceService) {
            ObjectInventories::create([
                'object_type' => object_inventories_object_type("CustomerInvoices"),
                'object_id' => $InvoiceService->invoice_id,
                'inventory_type' => object_inventories_inventory_type("InventoryServices"),
                'inventory_id' => $InvoiceService->service_id,
                'quantity' => $InvoiceService->quantity,
                'unit_price' => $InvoiceService->unit_price??0,
                'total_price' => null,
                'description' => str_replace("'","",str_replace('"','',$InvoiceService->description)),
                'tenant_id' => 1,
                'tax_rate' => null,
                'sub_total_amount' => null,
                'tax_amount' => null,
            ]);
            $progress->advance();
            unset($InvoiceService);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Sales Order Services', steps: SalesOrderService::count());
        $progress->start();
        foreach (SalesOrderService::get() as $SalesOrderService) {
            ObjectInventories::create([
                'object_type' => object_inventories_object_type("SalesOrders"),
                'object_id' => $SalesOrderService->sales_order_id,
                'inventory_type' => object_inventories_inventory_type("InventoryServices"),
                'inventory_id' => $SalesOrderService->service_id,
                'quantity' => $SalesOrderService->quantity,
                'unit_price' => $SalesOrderService->unit_price??0,
                'total_price' => null,
                'description' => str_replace("'","",str_replace('"','',$SalesOrderService->description)),
                'tenant_id' => 1,
                'tax_rate' => null,
                'sub_total_amount' => null,
                'tax_amount' => null,
            ]);
            $progress->advance();
            unset($SalesOrderService);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Supplier Invoice Custom Items', steps: SupplierInvoiceCustomItem::count());
        $progress->start();
        foreach (SupplierInvoiceCustomItem::get() as $SupplierInvoiceCustomItem) {
            CustomItems::create([
                'object_type' => custom_items_object_type("SupplierInvoices"),
                'object_id' => $SupplierInvoiceCustomItem->supplier_invoice_id,
                'name' => str_replace("'","",str_replace('"','',$SupplierInvoiceCustomItem->name)),
                'quantity' => $SupplierInvoiceCustomItem->quantity,
                'unit_price' => $SupplierInvoiceCustomItem->unit_price??0,
                'description' => str_replace("'","",str_replace('"','',$SupplierInvoiceCustomItem->description)),
                'total_price' => ($SupplierInvoiceCustomItem->unit_price??0 * $SupplierInvoiceCustomItem->quantity),
            ]);
            $progress->advance();
            unset($SupplierInvoiceCustomItem);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Expenses Voucher Custom Items', steps: ExpensesVoucherCustomItem::count());
        $progress->start();
        foreach (ExpensesVoucherCustomItem::get() as $ExpensesVoucherCustomItem) {
            CustomItems::create([
                'object_type' => custom_items_object_type("ExpensesVouchers"),
                'object_id' => $ExpensesVoucherCustomItem->expenses_voucher_id,
                'name' => str_replace("'","",str_replace('"','',$ExpensesVoucherCustomItem->name)),
                'quantity' => $ExpensesVoucherCustomItem->quantity,
                'unit_price' => $ExpensesVoucherCustomItem->unit_price??0,
                'description' => str_replace("'","",str_replace('"','',$ExpensesVoucherCustomItem->description)),
                'total_price' => ($ExpensesVoucherCustomItem->unit_price??0 * $ExpensesVoucherCustomItem->quantity),
            ]);
            $progress->advance();
            unset($ExpensesVoucherCustomItem);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Invoice Custom Items', steps: InvoiceCustomItem::count());
        $progress->start();
        foreach (InvoiceCustomItem::get() as $InvoiceCustomItem) {
            CustomItems::create([
                'object_type' => custom_items_object_type("CustomerInvoices"),
                'object_id' => $InvoiceCustomItem->invoice_id,
                'name' => str_replace("'","",str_replace('"','',$InvoiceCustomItem->name)),
                'quantity' => $InvoiceCustomItem->quantity,
                'unit_price' => $InvoiceCustomItem->unit_price??0,
                'description' => str_replace("'","",str_replace('"','',$InvoiceCustomItem->description)),
                'total_price' => ($InvoiceCustomItem->unit_price??0 * $InvoiceCustomItem->quantity),
            ]);
            $progress->advance();
            unset($InvoiceCustomItem);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Purchase Order Custom Items', steps: PurchaseOrderCustomItem::count());
        $progress->start();
        foreach (PurchaseOrderCustomItem::get() as $PurchaseOrderCustomItem) {
            CustomItems::create([
                'object_type' => custom_items_object_type("PurchaseOrders"),
                'object_id' => $PurchaseOrderCustomItem->purchase_order_id,
                'name' => str_replace("'","",str_replace('"','',$PurchaseOrderCustomItem->name)),
                'quantity' => $PurchaseOrderCustomItem->quantity,
                'unit_price' => $PurchaseOrderCustomItem->unit_price??0,
                'description' => str_replace("'","",str_replace('"','',$PurchaseOrderCustomItem->description)),
                'total_price' => ($PurchaseOrderCustomItem->unit_price??0 * $PurchaseOrderCustomItem->quantity),
            ]);
            $progress->advance();
            unset($PurchaseOrderCustomItem);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Quote Custom Items', steps: QuoteCustomItem::count());
        $progress->start();
        foreach (QuoteCustomItem::get() as $QuoteCustomItem) {
            CustomItems::create([
                'object_type' => custom_items_object_type("Quotes"),
                'object_id' => $QuoteCustomItem->quote_id,
                'name' => str_replace("'","",str_replace('"','',$QuoteCustomItem->name)),
                'quantity' => $QuoteCustomItem->quantity,
                'unit_price' => $QuoteCustomItem->unit_price??0,
                'description' => str_replace("'","",str_replace('"','',$QuoteCustomItem->description)),
                'total_price' => ($QuoteCustomItem->unit_price??0 * $QuoteCustomItem->quantity),
            ]);
            $progress->advance();
            unset($QuoteCustomItem);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Request For Quotation Custom Items', steps: RequestForQuotationCustomItem::count());
        $progress->start();
        foreach (RequestForQuotationCustomItem::get() as $RequestForQuotationCustomItem) {
            CustomItems::create([
                'object_type' => custom_items_object_type("RequestForQuotations"),
                'object_id' => $RequestForQuotationCustomItem->request_for_quotation_id,
                'name' => str_replace("'","",str_replace('"','',$RequestForQuotationCustomItem->name)),
                'quantity' => $RequestForQuotationCustomItem->quantity,
                'unit_price' => $RequestForQuotationCustomItem->unitPrice??0,
                'description' => str_replace("'","",str_replace('"','',$RequestForQuotationCustomItem->description)),
                'total_price' => ($RequestForQuotationCustomItem->unitPrice??0 * $RequestForQuotationCustomItem->quantity),
            ]);
            $progress->advance();
            unset($RequestForQuotationCustomItem);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Sales Order Custom Items', steps: SalesOrderCustomItem::count());
        $progress->start();
        foreach (SalesOrderCustomItem::get() as $SalesOrderCustomItem) {
            CustomItems::create([
                'object_type' => custom_items_object_type("SalesOrders"),
                'object_id' => $SalesOrderCustomItem->sales_order_id,
                'name' => str_replace("'","",str_replace('"','',$SalesOrderCustomItem->name)),
                'quantity' => $SalesOrderCustomItem->quantity,
                'unit_price' => $SalesOrderCustomItem->unit_price??0,
                'description' => str_replace("'","",str_replace('"','',$SalesOrderCustomItem->description)),
                'total_price' => ($SalesOrderCustomItem->unit_price??0 * $SalesOrderCustomItem->quantity),
            ]);
            $progress->advance();
            unset($SalesOrderCustomItem);
        }
        $progress->finish();

        info('Finished Inventories Migration');
    }
}

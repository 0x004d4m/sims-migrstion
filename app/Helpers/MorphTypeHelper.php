<?php
if (!function_exists('accountings_object_type')) {
    function accountings_object_type($key)
    {
        return [
            "Contacts" => "App\Models\Contact",
            "Organisations" => "App\Models\Organisation"
        ][$key];
    }
}
if (!function_exists('accounting_payables_object_type')) {
    function accounting_payables_object_type($key)
    {
        return [
            "SupplierContacts" => "App\Models\SupplierContact",
            "SupplierOrganisations" => "App\Models\SupplierOrganisation",
        ][$key];
    }
}
if (!function_exists('attachments_object_type')) {
    function attachments_object_type($key)
    {
        return [
            "InventoryProducts" => "App\Models\Inventory\InventoryProduct",
            "InventoryServices" => "App\Models\Inventory\InventoryService",
            "Contacts" => "App\Models\Contact",
            "Organisations" => "App\Models\Organisation",
            "SupplierContacts" => "App\Models\SupplierContact",
            "SupplierOrganisations" => "App\Models\SupplierOrganisation",
            "CustomerInvoices" => "App\Models\CustomerInvoice",
            "ExpensesAccounts" => "App\Models\ExpensesAccount",
            "ExpensesPaymentVouchers" => "App\Models\ExpensesPaymentVoucher",
            "ExpensesVouchers" => "App\Models\ExpensesVoucher",
            "Leads" => "App\Models\Lead",
            "Meetings" => "App\Models\Meeting",
            "Opportunities" => "App\Models\Opportunity",
            "PaymentVouchers" => "App\Models\PaymentVoucher",
            "PurchaseOrders" => "App\Models\PurchaseOrder",
            "Quotes" => "App\Models\Quote",
            "RequestForQuotations" => "App\Models\RequestForQuotation",
            "SalesOrders" => "App\Models\SalesOrder",
            "SupplierInvoices" => "App\Models\SupplierInvoice",
            "Vouchers" => "App\Models\Voucher",
        ][$key];
    }
}
if (!function_exists('comments_object_type')) {
    function comments_object_type($key)
    {
        return [
            "InventoryProducts" => "App\Models\Inventory\InventoryProduct",
            "InventoryServices" => "App\Models\Inventory\InventoryService",
            "Contacts" => "App\Models\Contact",
            "Organisations" => "App\Models\Organisation",
            "SupplierContacts" => "App\Models\SupplierContact",
            "SupplierOrganisations" => "App\Models\SupplierOrganisation",
            "CustomerInvoices" => "App\Models\CustomerInvoice",
            "ExpensesAccounts" => "App\Models\ExpensesAccount",
            "ExpensesPaymentVouchers" => "App\Models\ExpensesPaymentVoucher",
            "ExpensesVouchers" => "App\Models\ExpensesVoucher",
            "Leads" => "App\Models\Lead",
            "Meetings" => "App\Models\Meeting",
            "Opportunities" => "App\Models\Opportunity",
            "PaymentVouchers" => "App\Models\PaymentVoucher",
            "PurchaseOrders" => "App\Models\PurchaseOrder",
            "Quotes" => "App\Models\Quote",
            "RequestForQuotations" => "App\Models\RequestForQuotation",
            "SalesOrders" => "App\Models\SalesOrder",
            "SupplierInvoices" => "App\Models\SupplierInvoice",
            "Vouchers" => "App\Models\Voucher",
        ][$key];
    }
}
if (!function_exists('custom_items_object_type')) {
    function custom_items_object_type($key)
    {
        return [
            "SupplierInvoices" => "App\Models\SupplierInvoice",
            "ExpensesVouchers" => "App\Models\ExpensesVoucher",
            "CustomerInvoices" => "App\Models\CustomerInvoice",
            "PurchaseOrders" => "App\Models\PurchaseOrder",
            "Quotes" => "App\Models\Quote",
            "RequestForQuotations" => "App\Models\RequestForQuotation",
            "SalesOrders" => "App\Models\SalesOrder",
        ][$key];
    }
}
if (!function_exists('meetings_invited_models_invited_type')) {
    function meetings_invited_models_invited_type($key)
    {
        return [
            "Contacts" => "App\Models\Contact",
            "SupplierContacts" => "App\Models\SupplierContact",
            "Leads" => "App\Models\Lead",
        ][$key];
    }
}
if (!function_exists('meetings_invited_users_invited_user_type')) {
    function meetings_invited_users_invited_user_type($key)
    {
        return [
            "Users" => "App\Models\User"
        ][$key];
    }
}
if (!function_exists('meetings_object_type')) {
    function meetings_object_type($key)
    {
        return [
            "InventoryProducts" => "App\Models\Inventory\InventoryProduct",
            "InventoryServices" => "App\Models\Inventory\InventoryService",
            "Contacts" => "App\Models\Contact",
            "Organisations" => "App\Models\Organisation",
            "SupplierContacts" => "App\Models\SupplierContact",
            "SupplierOrganisations" => "App\Models\SupplierOrganisation",
            "CustomerInvoices" => "App\Models\CustomerInvoice",
            "ExpensesAccounts" => "App\Models\ExpensesAccount",
            "ExpensesPaymentVouchers" => "App\Models\ExpensesPaymentVoucher",
            "ExpensesVouchers" => "App\Models\ExpensesVoucher",
            "Leads" => "App\Models\Lead",
            "Meetings" => "App\Models\Meeting",
            "Opportunities" => "App\Models\Opportunity",
            "PaymentVouchers" => "App\Models\PaymentVoucher",
            "PurchaseOrders" => "App\Models\PurchaseOrder",
            "Quotes" => "App\Models\Quote",
            "RequestForQuotations" => "App\Models\RequestForQuotation",
            "SalesOrders" => "App\Models\SalesOrder",
            "SupplierInvoices" => "App\Models\SupplierInvoice",
            "Vouchers" => "App\Models\Voucher",
        ][$key];
    }
}
if (!function_exists('object_inventories_object_type')) {
    function object_inventories_object_type($key)
    {
        return [
            "CustomerInvoices" => "App\Models\CustomerInvoice",
            "ExpensesVouchers" => "App\Models\ExpensesVoucher",
            "PurchaseOrders" => "App\Models\PurchaseOrder",
            "Quotes" => "App\Models\Quote",
            "RequestForQuotations" => "App\Models\RequestForQuotation",
            "SalesOrders" => "App\Models\SalesOrder",
            "SupplierInvoices" => "App\Models\SupplierInvoice"
        ][$key];
    }
}
if (!function_exists('object_inventories_inventory_type')) {
    function object_inventories_inventory_type($key)
    {
        return [
            "InventoryServices" => "App\Models\Inventory\InventoryService",
            "InventoryProducts" => "App\Models\Inventory\InventoryProduct",
        ][$key];
    }
}
if (!function_exists('tasks_object_type')) {
    function tasks_object_type($key)
    {
        return [
            "InventoryProducts" => "App\Models\Inventory\InventoryProduct",
            "InventoryServices" => "App\Models\Inventory\InventoryService",
            "Contacts" => "App\Models\Contact",
            "Organisations" => "App\Models\Organisation",
            "SupplierContacts" => "App\Models\SupplierContact",
            "SupplierOrganisations" => "App\Models\SupplierOrganisation",
            "CustomerInvoices" => "App\Models\CustomerInvoice",
            "ExpensesAccounts" => "App\Models\ExpensesAccount",
            "ExpensesPaymentVouchers" => "App\Models\ExpensesPaymentVoucher",
            "ExpensesVouchers" => "App\Models\ExpensesVoucher",
            "Leads" => "App\Models\Lead",
            "Meetings" => "App\Models\Meeting",
            "Opportunitys" => "App\Models\Opportunity",
            "PaymentVouchers" => "App\Models\PaymentVoucher",
            "PurchaseOrders" => "App\Models\PurchaseOrder",
            "Quotes" => "App\Models\Quote",
            "RequestForQuotations" => "App\Models\RequestForQuotation",
            "SalesOrders" => "App\Models\SalesOrder",
            "SupplierInvoices" => "App\Models\SupplierInvoice",
            "Vouchers" => "App\Models\Voucher",
        ][$key];
    }
}

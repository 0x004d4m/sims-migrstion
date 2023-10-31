<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\info;

class Migrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sims:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate all data from old to new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call("sims:migrate-users");
        /*
            contacts
            contacts_addresses
            contacts_emails
            countries
            currencies
            groups
            industries
            job_titels
            leads
            leads_sources
            leads_statuses
            location
            nationalities
            organisations
            organisation_addresses
            supplier_categories
            supplier_contacts
            supplier_contact_address
            supplier_organisations
            supplier_organisation_address
            to_dos
            users
            user_locations
            */
        info('====================================================');

        $this->call("sims:migrate-sales");
        /*
            opportunities
            opportunity_sources
            quotes
            quote_stages
            sales_orders
            sales_orders_invoices
            sales_order_invoice_status
            sales_order_status
            sales_stages
            */
        info('====================================================');

        $this->call("sims:migrate-purchases");
        /*
            purchase_orders
            purchase_order_invoice
            purchase_order_statuses
            request_for_quotations
            request_for_quotation_stages
            */
        info('====================================================');

        $this->call("sims:migrate-expenses");
        /*
            expenses_account_addresses,
            expenses_accounts,
            expenses_categories,
            expenses_modes,
            expenses_payment_vouchers,
            expenses_vouchers,
            payment_methods,
            purchase_order_invoice_statuses,
            */
        info('====================================================');

        $this->call("sims:migrate-inventories");
        /*
            currencies,
            custom_items,
            inventory_product_categories,
            inventory_products,
            inventory_service_categories,
            inventory_services,
            inventory_service_usage_units,
            object_inventories,
            usage_units,
            */
        info('====================================================');

        $this->call("sims:migrate-vouchers");
        /*
            vouchers
            */
        info('====================================================');

        $this->call("sims:migrate-meetings");
        /*
            meetings
            meetings_invited_models
            meetings_invited_users
            */
        info('====================================================');

        $this->call("sims:migrate-tasks");
        /*
            task_priorities
            tasks
            task_statuses
            */
        info('====================================================');
    }
}

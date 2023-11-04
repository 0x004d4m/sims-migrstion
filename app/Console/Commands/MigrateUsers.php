<?php

namespace App\Console\Commands;

use App\Models\Sims_crm_db\{
    Contact,
    CrmGroup,
    JobTitle,
    Lead,
    Organization,
    SupplierContact,
    SupplierOrganization,
    Todo,
    User,
    UserLocation,
};
use App\Models\Sims_new\{
    ContactAddresses,
    ContactEmails,
    Contacts,
    Countries,
    Currencies,
    Groups,
    Industries,
    JobTitles,
    Leads,
    LeadsSources,
    LeadsStatuses,
    Locations,
    Nationalities,
    OrganisationAddresses,
    Organisations,
    SupplierCategories,
    SupplierContactAddresses,
    SupplierContacts,
    SupplierOrganisationAddresses,
    SupplierOrganisations,
    ToDos,
    UserLocations,
    Users,
};
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\info;
use function Laravel\Prompts\progress;

class MigrateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sims:migrate-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate users from old to new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        info('Starting Users Migration');


        $progress = progress(label: 'Migrating Job Titles', steps: JobTitle::count());
        $progress->start();
        foreach (JobTitle::get() as $JobTitle) {
            JobTitles::create([
                'id' => $JobTitle->id,
                'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $JobTitle->name)))),
                'tenant_id' => 1,
            ]);
            $progress->advance();
            unset($JobTitle);
        }
        $progress->finish();

        $progress = progress(label: 'Migrating Users', steps: User::count());
        $progress->start();
        foreach (User::get() as $User) {
            if ($User->nationalityOption) {
                if (Nationalities::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->nationalityOption->description)))))->count() == 0) {
                    Nationalities::create([
                        'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->nationalityOption->description)))),
                    ]);
                }
            } else {
                if (Nationalities::where('name', "-")->count() == 0) {
                    Nationalities::create([
                        'name' => "-",
                    ]);
                }
            }
            if ($User->addressDetail) {
                if ($User->addressDetail->country) {
                    if (Countries::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->addressDetail->country->name)))))->count() == 0) {
                        Countries::create([
                            "name" => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->addressDetail->country->name)))),
                        ]);
                    }
                } else {
                    if (Countries::where('name', "-")->count() == 0) {
                        Countries::create([
                            'name' => "-",
                        ]);
                    }
                }
            } else {
                if (Countries::where('name', "-")->count() == 0) {
                    Countries::create([
                        'name' => "-",
                    ]);
                }
            }
            Users::create([
                'id' => $User->id,
                'email' => $User->reachDetail ? (($User->reachDetail->email == "") ? str_replace("'", "", str_replace('"', '', "$User->first_name.$User->last_name.$User->id@simscreation.net")) : str_replace("'", "", str_replace('"', '', $User->reachDetail->email)) ?? str_replace("'", "", str_replace('"', '', "$User->first_name.$User->last_name.$User->id@simscreation.net"))) : str_replace("'", "", str_replace('"', '', "$User->first_name.$User->last_name@simscreation.net")),
                'password' => Hash::make(preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->userAuthenticationDetail->password))))),
                'mobile_number' => $User->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->reachDetail->mobile)))) : '-',
                'max_discount' => $User->discount_percentage,
                'identity_number' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->id_number)))),
                'first_name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->first_name)))),
                'last_name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->last_name)))),
                'nationality_id' => $User->nationalityOption ? Nationalities::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->nationalityOption->description)))))->first()->id : Nationalities::where('name', "-")->first()->id,
                'salary' => $User->basic_salary,
                'discount' => $User->discount_percentage,
                'approval_email' => $User->is_approval_email,
                'starting_date' => $User->job_start_date,
                'social_security' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->is_social_security)))),
                'phone' => $User->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->reachDetail->phone)))) : null,
                'mobile' => $User->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->reachDetail->second_mobile)))) : null,
                'fax' => $User->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->reachDetail->fax)))) : null,
                'address' => $User->addressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->addressDetail->address)))) : null,
                'city' => $User->addressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->addressDetail->city)))) : null,
                'region' => $User->addressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->addressDetail->city)))) : null,
                'postal_code' => $User->addressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->addressDetail->postal_code)))) : null,
                'job_titles_id' => $User->job_title_id,
                'country_id' => $User->addressDetail ? ($User->addressDetail->country ? Countries::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->addressDetail->country->name)))))->first()->id : Nationalities::where('name', "-")->first()->id) : Nationalities::where('name', "-")->first()->id,
                'second_name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->second_name)))),
                'third_name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->third_name)))),
                'username' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $User->userAuthenticationDetail->username)))),
                'tenant_id' => 1,
            ]);
            $progress->advance();
            unset($User);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating User Locations', steps: UserLocation::count());
        $progress->start();
        foreach (UserLocation::get() as $UserLocation) {
            if (Locations::where('id', $UserLocation->location->id)->count() == 0) {
                if ($UserLocation->location) {
                    if ($UserLocation->location->country) {
                        if (Countries::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $UserLocation->location->country->name)))))->count() == 0) {
                            Countries::create([
                                "name" => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $UserLocation->location->country->name)))),
                            ]);
                        }
                    } else {
                        if (Countries::where('name', "-")->count() == 0) {
                            Countries::create([
                                'name' => "-",
                            ]);
                        }
                    }
                } else {
                    if (Countries::where('name', "-")->count() == 0) {
                        Countries::create([
                            'name' => "-",
                        ]);
                    }
                }
                Locations::create([
                    'id' => $UserLocation->location->id,
                    'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $UserLocation->location->name)))),
                    'tax_rate' => $UserLocation->location->sales_tax_percentage,
                    'tax_free' => $UserLocation->location->sales_tax_percentage == 0 ? 1 : 0,
                    'description' => str_replace("'", "", str_replace('"', '', $UserLocation->location->description)),
                    'active' => 1,
                    'tenant_id' => 1,
                    'country_id' => $UserLocation->location->country ? (Countries::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $UserLocation->location->country->name)))))->first()->id) :  Countries::where('name', "-")->first()->id,
                    'currency_id' => $UserLocation->location->currency ? (Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $UserLocation->location->currency->currency_code)))))->first()->id) : null,
                ]);
            }
            UserLocations::create([
                'user_id' => $UserLocation->user_id,
                'location_id' => $UserLocation->location_id,
                'tenant_id' => 1
            ]);
            if (UserLocations::where('user_id', 1)->where('location_id', $UserLocation->location_id)->count() == 0) {
                UserLocations::create([
                    'user_id' => 1,
                    'location_id' => $UserLocation->location_id,
                    'tenant_id' => 1
                ]);
            }
            $progress->advance();
            unset($UserLocation);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Crm Groups', steps: CrmGroup::count());
        $progress->start();
        foreach (CrmGroup::get() as $CrmGroup) {
            Groups::create([
                'id' => $CrmGroup->id,
                'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $CrmGroup->name)))),
                'tenant_id' => 1,
                'user_id' => 1,
                'location_id' => $CrmGroup->location_id,
            ]);
            $progress->advance();
            unset($CrmGroup);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Organizations', steps: Organization::count());
        $progress->start();
        foreach (Organization::get() as $Organization) {
            if ($Organization->industryOption) {
                if (Industries::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->industryOption->description)))))->count() == 0) {
                    Industries::create([
                        'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->industryOption->description)))),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (Industries::where('name', "-")->count() == 0) {
                    Industries::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $Organization->currency ? (Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->currency->currency_code)))))->first()->id) : 1;
            Organisations::create([
                'id' => $Organization->id,
                'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->name)))),
                'description' => str_replace("'", "", str_replace('"', '', $Organization->description)),
                'industry_id' => $Organization->industryOption ? Industries::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->industryOption->description)))))->first()->id : null,
                'tax_free' => $Organization->is_tax_free,
                'primary_email' => $Organization->reachDetail ? ($Organization->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->reachDetail->email)))) : null) : null,
                'primary_mobile' => $Organization->reachDetail ? ($Organization->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->reachDetail->phone)))) : null) : null,
                'primary_phone' => $Organization->reachDetail ? ($Organization->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->reachDetail->mobile)))) : null) : null,
                'primary_fax' => $Organization->reachDetail ? ($Organization->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->reachDetail->fax)))) : null) : null,
                'website' => $Organization->reachDetail ? ($Organization->reachDetail ? (preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->reachDetail->website))))) : null) : null,
                'brand_name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->brand_name)))),
                'registration_number' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->registration_number)))),
                'tax_number' => $Organization->tax_number,
                'tax_rate' => $Organization->is_tax_free ? 0 : null,
                'creator_id' => null,
                'assigned_user_id' => 1,
                'tenant_id' => 1,
                'active' => 1,
                'starting_balance' => $Organization->starting_balance,
                'starting_balance_date' => $Organization->starting_balance_date,
                'currency_id' => $Organization->currency ? (Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->currency->currency_code)))))->first()->id) : null,
                'location_id' => $Organization->Document ? ($Organization->Document->location_id) : null,
                'u_id' => null,
                'account_number' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->account_number)))),
            ]);
            if ($Organization->billingAddressDetail || $Organization->shippingAddressDetail) {
                OrganisationAddresses::create([
                    'billing_country_id' => $Organization->billingAddressDetail ? $Organization->billingAddressDetail->country_id : null,
                    'billing_state' => $Organization->billingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->billingAddressDetail->state)))) : null,
                    'billing_postal_code' => $Organization->billingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->billingAddressDetail->postal_code)))) : null,
                    'billing_address' => $Organization->billingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->billingAddressDetail->address)))) : null,
                    'billing_city' => $Organization->billingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->billingAddressDetail->city)))) : null,
                    'billing_p_o_box' => $Organization->billingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->billingAddressDetail->post_office_box)))) : null,
                    'shipping_country_id' => $Organization->shippingAddressDetail ? $Organization->shippingAddressDetail->country_id : null,
                    'shipping_state' => $Organization->shippingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->shippingAddressDetail->state)))) : null,
                    'shipping_postal_code' => $Organization->shippingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->shippingAddressDetail->postal_code)))) : null,
                    'shipping_address' => $Organization->shippingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->shippingAddressDetail->address)))) : null,
                    'shipping_city' => $Organization->shippingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->shippingAddressDetail->city)))) : null,
                    'shipping_p_o_box' => $Organization->shippingAddressDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Organization->shippingAddressDetail->post_office_box)))) : null,
                    'organisation_id' => $Organization->id,
                ]);
            }
            $progress->advance();
            unset($Organization);
            unset($currency);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Leads', steps: Lead::count());
        $progress->start();
        foreach (Lead::get() as $Lead) {
            if ($Lead->leadSourceOption) {
                if (LeadsSources::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->leadSourceOption->description)))))->count() == 0) {
                    LeadsSources::create([
                        'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->leadSourceOption->description)))),
                    ]);
                }
            } else {
                if (LeadsSources::where('name', "-")->count() == 0) {
                    LeadsSources::create([
                        'name' => "-",
                    ]);
                }
            }
            if ($Lead->leadStatusOption) {
                if (LeadsStatuses::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->leadStatusOption->description)))))->count() == 0) {
                    LeadsStatuses::create([
                        'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->leadStatusOption->description)))),
                    ]);
                }
            } else {
                if (LeadsStatuses::where('name', "-")->count() == 0) {
                    LeadsStatuses::create([
                        'name' => "-",
                    ]);
                }
            }
            $currency = $Lead->person ? ($Lead->person->organization ? ($Lead->person->organization->currency ? Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->organization->currency->currency_code)))))->first()->id : 1) : 1) : 1;
            Leads::create([
                'id' => $Lead->id,
                'tenant_id' => 1,
                'location_id' => $Lead->Document ? ($Lead->Document->location_id) : null,
                'assigned_user_id' => 1,
                'lead_source_id' => $Lead->leadSourceOption ? LeadsSources::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->leadSourceOption->description)))))->first()->id : null,
                'lead_status_id' => $Lead->leadStatusOption ? LeadsStatuses::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->leadStatusOption->description)))))->first()->id : null,
                'organisation_id' => $Lead->person ? ($Lead->person->organization ? Organisations::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->organization->name)))))->first()->id : null) : null,
                'name' => $Lead->person ? str_replace("'", "", str_replace('"', '', $Lead->person->first_name)) . " " . ($Lead->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->reachDetail->second_phone)))) . " " : null) . ($Lead->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->reachDetail->third_phone)))) . " " : null) . preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->last_name)))) : null,
                'email' => $Lead->person ? ($Lead->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->reachDetail->email)))) ?? "-" : "-") : "-",
                'phone' => $Lead->person ? ($Lead->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->reachDetail->phone)))) ?? '-' : '-') : '-',
                'mobile_number' => $Lead->person ? ($Lead->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->reachDetail->mobile)))) : null) : null,
                'fax' => $Lead->person ? ($Lead->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->reachDetail->fax)))) : null) : null,
                'job_title' => $Lead->person ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->job_title)))) : null,
                'website' => $Lead->person ? ($Lead->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Lead->person->reachDetail->website)))) : null) : null,
                'description' => str_replace("'", "", str_replace('"', '', $Lead->description)),
                'is_converted' => $Lead->converted_to_contact,
                'payload' => null,
            ]);
            $progress->advance();
            unset($Lead);
            unset($currency);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Contacts', steps: Contact::count());
        $progress->start();
        foreach (Contact::get() as $Contact) {
            Contacts::create([
                'id' => $Contact->id,
                'mobile_number' => $Contact->person ? ($Contact->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->reachDetail->phone)))) : null) : null,
                'alt_mobile_number' => $Contact->person ? ($Contact->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->reachDetail->mobile)))) : null) : null,
                'type' => 'SMEs',
                'company_id' => 1,
                'tax_rate' => $Contact->is_tax_free ? 0 : ($Contact->tax_number == "" ? 0.160 : $Contact->tax_number ?? 0.160),
                'tax_number' => null,
                'tax_free' => $Contact->is_tax_free,
                'job_title' => $Contact->person ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->job_title)))) : null,
                'description' => str_replace("'", "", str_replace('"', '', $Contact->description)),
                'primary_fax' => $Contact->person ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->fax)))) : null,
                'creator_id' => null,
                'assigned_user_id' => 1,
                'organisation_id' => $Contact->person ? $Contact->person->organization_id : null,
                'tenant_id' => 1,
                'lead_id' => $Contact->lead_id,
                'starting_balance' => $Contact->starting_balance,
                'starting_balance_date' => $Contact->starting_balance_date,
                'currency_id' => $Contact->currency ? (Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->currency->currency_code)))))->first()->id) : null,
                'location_id' => $Contact->Document ? ($Contact->Document->location_id) : null,
                'first_name' => $Contact->person ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->first_name)))) : null,
                'last_name' => $Contact->person ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->last_name)))) : null,
                'u_id' => null,
                'account_number' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->account_number)))),
            ]);
            if ($Contact->person) {
                ContactEmails::create([
                    'email' => $Contact->person ? ($Contact->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->reachDetail->email)))) : null) : null,
                    'alternativet_email1' => $Contact->person ? ($Contact->person->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->reachDetail->second_email)))) : null) : null,
                    'contact_id' => $Contact->id,
                ]);
                if ($Contact->person->organization) {
                    if ($Contact->person->organization->shippingAddressDetail && $Contact->person->organization->billingAddressDetail) {
                        if (Countries::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->billingAddressDetail->country->name)))))->count() == 0) {
                            Countries::create([
                                "name" => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->billingAddressDetail->country->name)))),
                            ]);
                        }
                        if (Countries::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->shippingAddressDetail->country->name)))))->count() == 0) {
                            Countries::create([
                                "name" => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->shippingAddressDetail->country->name)))),
                            ]);
                        }
                        ContactAddresses::create([
                            'billing_country_id' => $Contact->person->organization->billingAddressDetail->country ? Countries::where('name', str_replace("'", "", str_replace('"', '', $Contact->person->organization->billingAddressDetail->country->name)))->first()->id : null,
                            'billing_state' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->billingAddressDetail->state)))),
                            'billing_postal_code' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->billingAddressDetail->postal_code)))),
                            'billing_address' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->billingAddressDetail->address)))),
                            'billing_city' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->billingAddressDetail->city)))),
                            'billing_p_o_box' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->billingAddressDetail->post_office_box)))),
                            'shipping_country_id' => $Contact->person->organization->shippingAddressDetail->country ? (Countries::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->shippingAddressDetail->country->name)))))->first()->id) : null,
                            'shipping_state' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->shippingAddressDetail->state)))),
                            'shipping_postal_code' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->shippingAddressDetail->postal_code)))),
                            'shipping_address' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->shippingAddressDetail->address)))),
                            'shipping_city' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->shippingAddressDetail->city)))),
                            'shipping_p_o_box' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $Contact->person->organization->shippingAddressDetail->post_office_box)))),
                            'contact_id' => $Contact->id,
                        ]);
                    }
                }
            }
            $progress->advance();
            unset($Contact);
            unset($currency);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Supplier Organizations', steps: SupplierOrganization::count());
        $progress->start();
        foreach (SupplierOrganization::get() as $SupplierOrganization) {
            if ($SupplierOrganization->supplierCategoryOption) {
                if (SupplierCategories::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->supplierCategoryOption->description)))))->count() == 0) {
                    SupplierCategories::create([
                        'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->supplierCategoryOption->description)))),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (SupplierCategories::where('name', "-")->count() == 0) {
                    SupplierCategories::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $SupplierOrganization->currency ? (Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->currency->currency_code)))))->first()->id) : 1;
            SupplierOrganisations::create([
                'id' => $SupplierOrganization->id,
                'location_id' => $SupplierOrganization->Document ? ($SupplierOrganization->Document->location_id) : null,
                'supplier_category_id' => $SupplierOrganization->supplierCategoryOption ? SupplierCategories::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->supplierCategoryOption->description)))))->first()->id : SupplierCategories::where('name', "-")->first()->id,
                'assigned_user_id' => 1,
                'tenant_id' => 1,
                'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->name)))),
                'description' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->description)))),
                'tax_free' => $SupplierOrganization->is_tax_free,
                'primary_email' => $SupplierOrganization->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->reachDetail->email)))) : null,
                'primary_mobile' => $SupplierOrganization->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->reachDetail->mobile)))) : null,
                'primary_phone' => $SupplierOrganization->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->reachDetail->phone)))) : null,
                'primary_fax' => $SupplierOrganization->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->reachDetail->fax)))) : null,
                'website' => $SupplierOrganization->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->reachDetail->website)))) : null,
                'brand_name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->brand_name)))),
                'registration_number' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->registration_number)))),
                'tax_number' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->tax_number)))),
                'tax_rate' => $SupplierOrganization->is_tax_free ? 0 : 0.160,
                'starting_balance' => $SupplierOrganization->starting_balance,
                'starting_balance_date' => $SupplierOrganization->starting_balance_date,
                'currency_id' => $SupplierOrganization->currency ? (Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->currency->currency_code)))))->first()->id) : null,
                'u_id' => null,
                'account_number' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->account_number)))),
            ]);
            if ($SupplierOrganization->addressDetail) {
                SupplierOrganisationAddresses::create([
                    'billing_country_id' => $SupplierOrganization->country_id,
                    'billing_state' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->state)))),
                    'billing_postal_code' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->postal_code)))),
                    'billing_address' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->address)))),
                    'billing_city' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->city)))),
                    'billing_p_o_box' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierOrganization->post_office_box)))),
                    'supplier_organisation_id' => $SupplierOrganization->id,
                ]);
            }
            $progress->advance();
            unset($SupplierOrganization);
            unset($currency);
        }
        $progress->finish();


        $progress = progress(label: 'Migrating Supplier Contact Organizations', steps: SupplierContact::count());
        $progress->start();
        foreach (SupplierContact::get() as $SupplierContact) {
            if ($SupplierContact->supplierCategoryOption) {
                if (SupplierCategories::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->supplierCategoryOption->description)))))->count() == 0) {
                    SupplierCategories::create([
                        'name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->supplierCategoryOption->description)))),
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (SupplierCategories::where('name', "-")->count() == 0) {
                    SupplierCategories::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            $currency = $SupplierContact->currency ? (Currencies::where('code', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->currency->currency_code)))))->first()->id) : 1;
            SupplierContacts::create([
                'id' => $SupplierContact->id,
                'location_id' => $SupplierContact->Document ? ($SupplierContact->Document->location_id) : null,
                'supplier_category_id' => $SupplierContact->supplierCategoryOption ? SupplierCategories::where('name', preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->supplierCategoryOption->description)))))->first()->id : SupplierCategories::where('name', "-")->first()->id,
                'supplier_organisation_id' => $SupplierContact->supplier_organization_id,
                'assigned_user_id' => 1,
                'tenant_id' => 1,
                'first_name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->first_name)))),
                'last_name' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->last_name)))),
                'description' => str_replace("'", "", str_replace('"', '', $SupplierContact->description)),
                'tax_free' => $SupplierContact->is_tax_free,
                'primary_email' => $SupplierContact->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->reachDetail->email)))) : null,
                'primary_mobile' => $SupplierContact->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->reachDetail->mobile)))) : null,
                'primary_phone' => $SupplierContact->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->reachDetail->phone)))) : null,
                'primary_fax' => $SupplierContact->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->reachDetail->fax)))) : null,
                'website' => $SupplierContact->reachDetail ? preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->reachDetail->website)))) : null,
                'tax_number' => $SupplierContact->tax_number,
                'tax_rate' => $SupplierContact->is_tax_free ? 0 : 0.16,
                'starting_balance' => $SupplierContact->starting_balance,
                'starting_balance_date' => $SupplierContact->starting_balance_date,
                'currency_id' => $currency,
                'account_number' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->account_number)))),
            ]);
            if ($SupplierContact->addressDetail) {
                SupplierContactAddresses::create([
                    'billing_country_id' => $SupplierContact->country_id,
                    'billing_state' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->state)))),
                    'billing_postal_code' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->postal_code)))),
                    'billing_address' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->address)))),
                    'billing_city' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->city)))),
                    'billing_p_o_box' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $SupplierContact->post_office_box)))),
                    'supplier_contact_id' => $SupplierContact->id,
                ]);
            }
            $progress->advance();
            unset($SupplierOrganization);
            unset($currency);
        }
        $progress->finish();

        $progress = progress(label: 'Migrating To dos', steps: Todo::count());
        $progress->start();
        foreach (Todo::get() as $ToDo) {
            ToDos::create([
                'id' => $ToDo->id,
                'subject' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $ToDo->subject)))),
                'description' => str_replace("'", "", str_replace('"', '', $ToDo->description)),
                'note' => null,
                'date' => $ToDo->time,
                'is_completed' => preg_replace('/[\x00-\x1F\x7F]/', '',  preg_replace('/\s+/', ' ', str_replace("'", "", str_replace('"', '', $ToDo->is_completed)))),
                'creator_id' => 1,
                'assigned_user_id' => 1,
                'tenant_id' => 1,
                'location_id' => null,
            ]);
            $progress->advance();
            unset($ToDo);
        }
        $progress->finish();


        info('Finished Users Migration');
    }
}

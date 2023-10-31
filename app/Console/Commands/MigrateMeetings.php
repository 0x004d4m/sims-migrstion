<?php

namespace App\Console\Commands;

use App\Models\Sims_crm_db\{
    Document,
    Meeting,
    MeetingContact,
    MeetingLead,
    MeetingSupplierContact,
    MeetingUser
};
use App\Models\Sims_new\{
    Locations,
    Meetings,
    MeetingsInvitedModels,
    MeetingsInvitedUsers,
};
use Illuminate\Console\Command;
use function Laravel\Prompts\info;
use function Laravel\Prompts\progress;

class MigrateMeetings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sims:migrate-meetings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate meetings from old to new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        ini_set('memory_limit', '-1');
        info('Starting Meetings Migration');


        $progress = progress(label: 'Migrating Meetings', steps: Meeting::count());
        $progress->start();
        foreach (Meeting::get() as $Meeting) {
            if (Locations::where('name', $Meeting->location)->count() == 0) {
                Locations::create([
                    'name' => $Meeting->location,
                    'description' => $Meeting->location,
                    'tenant_id' => 1,
                ]);
            }
            Meetings::create([
                'id' => $Meeting->id,
                'title' => $Meeting->title,
                'location' => $Meeting->location,
                'description' => $Meeting->description,
                'tenant_id' => 1,
                'location_id' => Locations::where('name', $Meeting->location)->first()->id,
                'related_document' => $Meeting->document ? (Document::where('id', $Meeting->document->id)->first() ? (Document::where('id', $Meeting->document->id)->first()->file_name) : null) : null,
                'status' => "Held Meeting",
                'meeting_start_date' => $Meeting->start_time,
                'meeting_end_date' => $Meeting->end_time
            ]);
            if (MeetingLead::where('meeting_id', $Meeting->id)->count() > 0) {
                foreach (MeetingLead::where('meeting_id', $Meeting->id)->get() as $MeetingLead) {
                    MeetingsInvitedModels::create([
                        'invited_type' => meetings_invited_models_invited_type("Leads"),
                        'invited_id' => $MeetingLead->lead_id,
                        'meeting_id' => $Meeting->id,
                    ]);
                }
            }
            if (MeetingUser::where('meeting_id', $Meeting->id)->count() > 0) {
                foreach (MeetingUser::where('meeting_id', $Meeting->id)->get() as $MeetingUser) {
                    MeetingsInvitedUsers::create([
                        'invited_user_type' => meetings_invited_users_invited_user_type("Users"),
                        'invited_user_id' => $MeetingUser->user_id,
                        'meeting_id' => $Meeting->id,
                    ]);
                }
            }
            if (MeetingContact::where('meeting_id', $Meeting->id)->count() > 0) {
                foreach (MeetingContact::where('meeting_id', $Meeting->id)->get() as $MeetingContact) {
                    MeetingsInvitedModels::create([
                        'invited_type' => meetings_invited_models_invited_type("Contacts"),
                        'invited_id' => $MeetingContact->contact_id,
                        'meeting_id' => $Meeting->id,
                    ]);
                }
            }
            if (MeetingSupplierContact::where('meeting_id', $Meeting->id)->count() > 0) {
                foreach (MeetingSupplierContact::where('meeting_id', $Meeting->id)->get() as $MeetingSupplierContact) {
                    MeetingsInvitedModels::create([
                        'invited_type' => meetings_invited_models_invited_type("SupplierContacts"),
                        'invited_id' => $MeetingSupplierContact->supplier_contact_id,
                        'meeting_id' => $Meeting->id,
                    ]);
                }
            }
            $progress->advance();
            unset($Meeting);
        }
        $progress->finish();


        info('Finished Meetings Migration');
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Sims_crm_db\{
    DocumentAttachment,
    Task
};
use App\Models\Sims_new\{
    TaskPriorities,
    Tasks,
    TaskStatuses
};
use Illuminate\Console\Command;
use function Laravel\Prompts\info;
use function Laravel\Prompts\progress;

class MigrateTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sims:migrate-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate tasks from old to new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        info('Starting Tasks Migration');


        $progress = progress(label: 'Migrating Tasks', steps: Task::count());
        $progress->start();
        foreach (Task::get() as $Task) {
            if ($Task->taskPriorityOption) {
                if (TaskPriorities::where('name', str_replace("'","",str_replace('"','',$Task->taskPriorityOption->description)))->count() == 0) {
                    TaskPriorities::create([
                        'name' => str_replace("'","",str_replace('"','',$Task->taskPriorityOption->description)),
                        'tenant_id' => 1,
                        'u_id' => (TaskPriorities::count() + 1),
                    ]);
                }
            } else {
                if (TaskPriorities::where('name', "-")->count() == 0) {
                    TaskPriorities::create([
                        'name' => "-",
                        'tenant_id' => 1,
                        'u_id' => (TaskPriorities::count() + 1),
                    ]);
                }
            }
            if ($Task->taskStatusOption) {
                if (TaskStatuses::where('name', str_replace("'","",str_replace('"','',$Task->taskStatusOption->description)))->count() == 0) {
                    TaskStatuses::create([
                        'name' => str_replace("'","",str_replace('"','',$Task->taskStatusOption->description)),
                        'tenant_id' => 1,
                        'u_id' => (TaskStatuses::count() + 1),
                    ]);
                }
            } else {
                if (TaskStatuses::where('name', "-")->count() == 0) {
                    TaskStatuses::create([
                        'name' => "-",
                        'tenant_id' => 1,
                        'u_id' => (TaskStatuses::count() + 1),
                    ]);
                }
            }
            Tasks::create([
                'id' => $Task->id,
                'subject' => str_replace("'","",str_replace('"','',$Task->subject)),
                'description' => str_replace("'","",str_replace('"','',$Task->description)),
                'priority' => $Task->taskPriorityOption ? str_replace("'","",str_replace('"','',$Task->taskPriorityOption->description)) : 'Low',
                'status_id' => $Task->taskStatusOption ? TaskStatuses::where('name', str_replace("'","",str_replace('"','',$Task->taskStatusOption->description)))->first()->id : TaskStatuses::where('name', "-")->first()->id,
                'start_time' => str_replace("'","",str_replace('"','',$Task->start_time)),
                'end_time' => str_replace("'","",str_replace('"','',$Task->end_time)),
                'assigned_user_id' => $Task->document ? $Task->document->user_id??1 : 1,
                'tenant_id' => 1,
                'u_id' => (Tasks::count() + 1),
                'task_priority_id' => $Task->taskPriorityOption ? TaskPriorities::where('name', str_replace("'","",str_replace('"','',$Task->taskPriorityOption->description)))->first()->id : TaskPriorities::where('name', "-")->first()->id,
                'related_document' => $Task->document ? (DocumentAttachment::where('document_id', $Task->document->id)->first() ? (str_replace("'", "", str_replace('"', '', DocumentAttachment::where('document_id', $Task->document->id)->first()->file_name))) : null) : null,
                'created_at' => ($Task->document ? ($Task->document->create_time) : null),
                'updated_at' => ($Task->document ? ($Task->document->last_edit_time) : null),
            ]);
            $progress->advance();
            unset($Task);
        }
        $progress->finish();


        info('Finished Tasks Migration');
    }
}

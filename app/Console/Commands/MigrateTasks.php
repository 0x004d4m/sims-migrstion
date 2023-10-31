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
                if (TaskPriorities::where('name', $Task->taskPriorityOption->description)->count() == 0) {
                    TaskPriorities::create([
                        'name' => $Task->taskPriorityOption->description,
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (TaskPriorities::where('name', "-")->count() == 0) {
                    TaskPriorities::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            if ($Task->taskStatusOption) {
                if (TaskStatuses::where('name', $Task->taskStatusOption->description)->count() == 0) {
                    TaskStatuses::create([
                        'name' => $Task->taskStatusOption->description,
                        'tenant_id' => 1,
                    ]);
                }
            } else {
                if (TaskStatuses::where('name', "-")->count() == 0) {
                    TaskStatuses::create([
                        'name' => "-",
                        'tenant_id' => 1,
                    ]);
                }
            }
            Tasks::create([
                'id' => $Task->id,
                'subject' => $Task->subject,
                'description' => $Task->description,
                'priority' => $Task->taskPriorityOption ? $Task->taskPriorityOption->description : 'Low',
                'status_id' => $Task->taskStatusOption ? TaskStatuses::where('name', $Task->taskStatusOption->description)->first()->id : TaskStatuses::where('name', "-")->first()->id,
                'start_time' => $Task->start_time,
                'end_time' => $Task->end_time,
                'assigned_user_id' => 1,
                'tenant_id' => 1,
                'task_priority_id' => $Task->taskPriorityOption ? TaskPriorities::where('name', $Task->taskPriorityOption->description)->first()->id : TaskPriorities::where('name', "-")->first()->id,
                'related_document' => $Task->document ? (DocumentAttachment::where('document_id', $Task->document->id)->first() ? (DocumentAttachment::where('document_id', $Task->document->id)->first()->file_name) : null) : null,
            ]);
            $progress->advance();
            unset($Task);
        }
        $progress->finish();


        info('Finished Tasks Migration');
    }
}

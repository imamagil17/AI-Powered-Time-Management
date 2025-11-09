<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TimeEntry;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;
use App\Policies\TimeEntryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapping Policy karena ada error terkait hak akses user saat show detail project
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
        TimeEntry::class => TimeEntryPolicy::class,
    ];

    /**
     * Register semua gate dan policy aplikasi.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
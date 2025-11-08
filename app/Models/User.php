<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project; // import project model untuk relasi
use App\Models\Task;   // Import tasjk model untuk relasi
use App\Models\TimeEntry; // Import time entry model untuk relasi

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * definisi relasi dengan model Project (proyek yang dimiliki oleh user)
     * implementasi relasi one-to-many dimana satu user dapat memiliki banyak proyek
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'owner_id');
    }

    /**
     * definisi relasi dengan model Project (proyek yang ditugaskan ke user)
     * implementasi relasi many-to-many melalui tabel pivot project_user
     */
    public function assignedProjects()
    {
        return $this->belongsToMany(Project::class, 'project_user');
    }

    /**
     * definisi relasi dengan model Task (tugas yang ditugaskan ke user)
     *  implementasi relasi many-to-many melalui tabel pivot task_user
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user');
    }

    /**
     * definisi relasi dengan model TimeEntry (entri waktu yang dibuat oleh user)
     * implementasi relasi one-to-many dimana satu user dapat memiliki banyak entri waktu
     */
    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }
}

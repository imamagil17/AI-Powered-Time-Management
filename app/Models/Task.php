<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'estimated_hours',
        'ai_predicted_hours',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'estimated_hours' => 'decimal:2',
        'ai_predicted_hours' => 'decimal:2',
    ];

    // Definisikan relasi dengan model Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Mendefinisikan relasi many-to-many dengan model User (anggota tugas)
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

    // Mendefinisikan relasi one-to-many dengan model TimeEntry
    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }
}
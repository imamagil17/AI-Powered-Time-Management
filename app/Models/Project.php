<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'status',
        'start_date',
        'due_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
    ];

    // Definisikan relasi dengan model User (pemilik proyek)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Definisikan relasi many-to-many dengan model User (anggota proyek)
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    // Definisikan relasi one-to-many dengan model Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Menentukan apakah user dapat melihat daftar model.
     */
    public function viewAny(User $user): bool
    {
        return true; // Mengizinkan semua user melihat daftar tugas
    }

    /**
     * Menentukan apakah user dapat melihat model tertentu.
     */
    public function view(User $user, Task $task): bool
    {
        // Mengizinkan user melihat tugas yang mereka miliki atau yang ada di proyek mereka
        return $user->tasks->contains($task) || $user->id === $task->project->owner_id;
    }

    /**
     * Menentukan apakah user dapat membuat model.
     */
    public function create(User $user): bool
    {
        return true; // Mengizinkan semua user terautentikasi membuat tugas
    }

    /**
     * Menentukan apakah user dapat memperbarui model.
     */
    public function update(User $user, Task $task): bool
    {
        // MEngizinkan user memperbarui tugas yang mereka miliki atau mereka yang memiliki proyek
        return $user->tasks->contains($task) || $user->id === $task->project->owner_id;
    }

    /**
     * Menentukan apakah user dapat menghapus model.
     */
    public function delete(User $user, Task $task): bool
    {
        // Mengizinkan user menghapus tugas yang mereka miliki atau mereka yang memiliki proyek
        return $user->tasks->contains($task) || $user->id === $task->project->owner_id;
    }

    /**
     * Menen
     */
    public function restore(User $user, Task $task): bool
    {
        return $user->tasks->contains($task) || $user->id === $task->project->owner_id;
    }

    /**
     * Menentukan apakah user dapat menghapus permanen model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return $user->tasks->contains($task) || $user->id === $task->project->owner_id;
    }
}

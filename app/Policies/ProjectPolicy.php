<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Menentukan apakah user dapat melihat daftar model.
     */
    public function viewAny(User $user): bool
    {
        return true; // Izinkan semua user melihat daftar proyek
    }

    /**
     * Menentukan apakah user dapat melihat model tertentu.
     */
    public function view(User $user, Project $project): bool
    {
        // Mengizinkan user melihat proyek yang mereka miliki
        return $user->id === $project->owner_id;
    }

    /**
     * Menentukan apakah user dapat membuat model.
     */
    public function create(User $user): bool
    {
        return true; // Mengizinkan semua user terautentikasi membuat proyek
    }

    /**
     * Menentukan apakah user dapat memperbarui model.
     */
    public function update(User $user, Project $project): bool
    {
        // Mengizinkan user memperbarui proyek yang mereka miliki
        return $user->id === $project->owner_id;
    }

    /**
     * Menentukan apakah user dapat menghapus model.
     */
    public function delete(User $user, Project $project): bool
    {
        // Mengizinkan user menghapus proyek yang mereka miliki
        return $user->id === $project->owner_id;
    }

    /**
     * Menentukan apakah user dapat mengembalikan model yang dihapus.
     */
    public function restore(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

    /**
     * Menentukan apakah user dapat menghapus permanen model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }
}

<?php

namespace App\Policies;

use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TimeEntryPolicy
{
    /**
     * Menentukan apakah user dapat melihat daftar model.
     */
    public function viewAny(User $user): bool
    {
        return true; // Mengizinkan semua user melihat daftar entri waktu
    }

    /**
     * Menentukan apakah user dapat melihat model tertentu.
     */
    public function view(User $user, TimeEntry $timeEntry): bool
    {
        // Mengizinkan user melihat entri waktu yang mereka rekam
        return $user->id === $timeEntry->user_id;
    }

    /**
     * Menentukan apakah user dapat membuat model.
     */
    public function create(User $user): bool
    {
        return true; // Mengizinkan semua user terautentikasi membuat entri waktu
    }

    /**
     * Menentukan apakah user dapat memperbarui model.
     */
    public function update(User $user, TimeEntry $timeEntry): bool
    {
        // Mengizinkan user memperbarui entri waktu yang mereka rekam
        return $user->id === $timeEntry->user_id;
    }

    /**
     * Menentukan apakah user dapat menghapus model.
     */
    public function delete(User $user, TimeEntry $timeEntry): bool
    {
        // Mengizinkan user menghapus entri waktu yang mereka rekam
        return $user->id === $timeEntry->user_id;
    }

    /**
     * Menentukan apakah user dapat mengembalikan model yang dihapus.
     */
    public function restore(User $user, TimeEntry $timeEntry): bool
    {
        return $user->id === $timeEntry->user_id;
    }

    /**
     * Menentukan apakah user dapat menghapus permanen model.
     */
    public function forceDelete(User $user, TimeEntry $timeEntry): bool
    {
        return $user->id === $timeEntry->user_id;
    }
}

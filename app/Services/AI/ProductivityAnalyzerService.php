<?php

namespace App\Services\AI;

use App\Models\User;
use App\Models\TimeEntry;

class ProductivityAnalyzerService
{
    /**
     * Analisis produktivitas pengguna berdasarkan entri waktu mereka
     * 
     * @param User $user The user to analyze
     * @param string $period Period to analyze (e.g., 'week', 'month')
     * @return array Analysis results
     */
    public function analyzeUserProductivity(User $user, string $period = 'week'): array
    {
        $timeEntries = $user->timeEntries();
        
        // Apply period filter
        switch ($period) {
            case 'week':
                $timeEntries = $timeEntries->where('created_at', '>=', now()->subWeek());
                break;
            case 'month':
                $timeEntries = $timeEntries->where('created_at', '>=', now()->subMonth());
                break;
            case 'year':
                $timeEntries = $timeEntries->where('created_at', '>=', now()->subYear());
                break;
        }
        
        $timeEntries = $timeEntries->get();
        
        $totalHours = $timeEntries->sum('duration_minutes') / 60;
        $totalTasks = $timeEntries->pluck('task_id')->unique()->count();
        $avgHoursPerTask = $totalTasks > 0 ? $totalHours / $totalTasks : 0;
        
        // Menentukan jam paling produktif
        $hourlyProductivity = [];
        foreach ($timeEntries as $entry) {
            $hour = $entry->start_time->hour;
            if (!isset($hourlyProductivity[$hour])) {
                $hourlyProductivity[$hour] = 0;
            }
            $hourlyProductivity[$hour] += $entry->duration_minutes / 60;
        }
        
        $mostProductiveHour = !empty($hourlyProductivity) ? array_keys($hourlyProductivity, max($hourlyProductivity))[0] : null;
        
        // Menentukan hari paling produktif
        $dayProductivity = [];
        foreach ($timeEntries as $entry) {
            $day = $entry->start_time->format('l'); // Day name (Monday, Tuesday, etc.)
            if (!isset($dayProductivity[$day])) {
                $dayProductivity[$day] = 0;
            }
            $dayProductivity[$day] += $entry->duration_minutes / 60;
        }
        
        $mostProductiveDay = !empty($dayProductivity) ? array_keys($dayProductivity, max($dayProductivity))[0] : null;
        
        return [
            'total_hours' => $totalHours,
            'total_tasks' => $totalTasks,
            'avg_hours_per_task' => round($avgHoursPerTask, 2),
            'most_productive_hour' => $mostProductiveHour,
            'most_productive_day' => $mostProductiveDay,
            'hourly_productivity' => $hourlyProductivity,
            'day_productivity' => $dayProductivity,
        ];
    }
    
    /**
     * Generate saran untuk meningkatkan produktivitas berdasarkan analisis
     * 
     * @param User $user The user to generate suggestions for
     * @return array Suggestions for improving productivity
     */
    public function generateProductivitySuggestions(User $user): array
    {
        $analysis = $this->analyzeUserProductivity($user);
        
        $suggestions = [];
        
        // Saran untuk jam kerja optimal
        if ($analysis['most_productive_hour']) {
            $suggestions[] = "You're most productive around " . $analysis['most_productive_hour'] . " o'clock. Try scheduling your most important tasks during this time.";
        }
        
        // Saran untuk hari kerja optimal
        if ($analysis['most_productive_day']) {
            $suggestions[] = "Your most productive day is {$analysis['most_productive_day']}. Consider scheduling important meetings and deep work on this day.";
        }
        
        // Saran unntuk durasi tugas
        if ($analysis['avg_hours_per_task'] > 4) {
            $suggestions[] = "Your average task duration is quite long ({$analysis['avg_hours_per_task']} hours). Consider breaking tasks down into smaller, more manageable chunks.";
        } elseif ($analysis['avg_hours_per_task'] < 0.5) {
            $suggestions[] = "Your average task duration is very short ({$analysis['avg_hours_per_task']} hours). This might indicate task fragmentation. Consider grouping similar small tasks together.";
        }
        
        // Saran Umum
        if ($analysis['total_hours'] < 20) {
            $suggestions[] = "You're tracking fewer than 20 hours of work this period. Ensure you're adequately tracking your time to get accurate insights.";
        } else {
            $suggestions[] = "Great job maintaining consistent time tracking! This helps generate accurate productivity insights.";
        }
        
        return $suggestions;
    }
}
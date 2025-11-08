<x-app-layout>
    <style>
        @keyframes gracefulFadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-graceful {
            animation: gracefulFadeInUp 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            opacity: 0;
        }
    </style>

    <x-slot name="header">
        <div class="animate-graceful" style="animation-delay: 0s;">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-textlight leading-tight">
                {{ __('Edit Catatan Waktu') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-secondary">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-card overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-textlight">
                    <form method="POST" action="{{ route('time-entries.update', $timeEntry) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 animate-graceful" style="animation-delay: 0.1s;">
                            <label for="task_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Tugas *
                            </label>
                            <select name="task_id" id="task_id" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                @foreach($tasks as $task)
                                    <option value="{{ $task->id }}" {{ old('task_id', $timeEntry->task_id) == $task->id ? 'selected' : '' }}>
                                        {{ $task->title }} ({{ $task->project->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('task_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 animate-graceful" style="animation-delay: 0.2s;">
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Waktu Mulai *
                                </label>
                                <input type="datetime-local" name="start_time" id="start_time" 
                                       value="{{ old('start_time', $timeEntry->start_time->format('Y-m-d\TH:i')) }}" 
                                       required 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                @error('start_time')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Waktu Selesai *
                                </label>
                                <input type="datetime-local" name="end_time" id="end_time" 
                                       value="{{ old('end_time', $timeEntry->end_time->format('Y-m-d\TH:i')) }}" 
                                       required 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                @error('end_time')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 animate-graceful" style="animation-delay: 0.3s;">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Catatan
                            </label>
                            <textarea name="notes" id="notes" 
                                      rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">{{ old('notes', $timeEntry->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="animate-graceful" style="animation-delay: 0.4s;">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent 
                                           rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                           hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 
                                           focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150">
                                Update Catatan Waktu
                            </button>
                            
                            <a href="{{ route('time-entries.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent 
                                      rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                      hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 
                                      focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150 ml-2">
                                Batal
                            </a>
                            
                            <form action="{{ route('time-entries.destroy', $timeEntry) }}" method="POST" class="inline ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent 
                                               rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                               hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 
                                               focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus catatan waktu ini?')">
                                    Hapus Catatan
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
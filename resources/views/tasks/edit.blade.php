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
                {{ __('Edit Tugas: ') . $task->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-secondary">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-card overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-textlight">
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 animate-graceful" style="animation-delay: 0.1s;">
                            <label for="project_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Proyek *
                            </label>
                            <select name="project_id" id="project_id" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 animate-graceful" style="animation-delay: 0.2s;">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Judul Tugas *
                            </label>
                            <input type="text" name="title" id="title" 
                                   value="{{ old('title', $task->title) }}" 
                                   required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 animate-graceful" style="animation-delay: 0.3s;">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Deskripsi Tugas
                            </label>
                            <textarea name="description" id="description" 
                                      rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">{{ old('description', $task->description) }}</textarea>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Deskripsi tugas akan digunakan untuk prediksi durasi otomatis menggunakan AI.
                            </p>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 animate-graceful" style="animation-delay: 0.4s;">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Status
                                </label>
                                <select name="status" id="status" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                    <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }}>To Do</option>
                                    <option value="in progress" {{ old('status', $task->status) == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Prioritas
                                </label>
                                <select name="priority" id="priority" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                    <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Rendah</option>
                                    <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Sedang</option>
                                    <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Tinggi</option>
                                </select>
                                @error('priority')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 animate-graceful" style="animation-delay: 0.5s;">
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Tenggat Waktu
                                </label>
                                <input type="date" name="due_date" id="due_date" 
                                       value="{{ old('due_date', $task->due_date) }}" 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                @error('due_date')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="estimated_hours" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Estimasi Durasi (jam)
                                </label>
                                <input type="number" name="estimated_hours" id="estimated_hours" 
                                       value="{{ old('estimated_hours', $task->estimated_hours) }}" 
                                       step="0.1" min="0.1" max="168"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                @error('estimated_hours')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="animate-graceful" style="animation-delay: 0.6s;">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent 
                                           rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                           hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 
                                           focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150">
                                Update Tugas
                            </button>
                            
                            <a href="{{ route('projects.show', $task->project) }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent 
                                      rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                      hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 
                                      focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150 ml-2">
                                Batal
                            </a>
                            
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent 
                                               rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                               hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 
                                               focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                    Hapus Tugas
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
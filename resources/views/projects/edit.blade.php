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
                {{ __('Edit Proyek: ') . $project->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-secondary">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-card overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-textlight">
                    <form method="POST" action="{{ route('projects.update', $project) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 animate-graceful" style="animation-delay: 0.1s;">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nama Proyek *
                            </label>
                            <input type="text" name="name" id="name" 
                                   value="{{ old('name', $project->name) }}" 
                                   required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 animate-graceful" style="animation-delay: 0.2s;">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Deskripsi Proyek
                            </label>
                            <textarea name="description" id="description" 
                                      rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 animate-graceful" style="animation-delay: 0.3s;">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Status
                                </label>
                                <select name="status" id="status" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                    <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in progress" {{ old('status', $project->status) == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Tenggat Waktu
                                </label>
                                <input type="date" name="due_date" id="due_date" 
                                       value="{{ old('due_date', $project->due_date) }}" 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-secondary dark:text-white">
                                @error('due_date')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="animate-graceful" style="animation-delay: 0.4s;">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent 
                                           rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                           hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 
                                           focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150">
                                Update Proyek
                            </button>
                            
                            <a href="{{ route('projects.show', $project) }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent 
                                      rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                      hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 
                                      focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150 ml-2">
                                Batal
                            </a>
                            
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent 
                                               rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                               hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 
                                               focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini? Semua tugas dalam proyek ini juga akan dihapus.')">
                                    Hapus Proyek
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
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
                {{ __('Tugas Saya') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-secondary">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-card overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-textlight">
                    <div class="mb-6 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-textlight">Daftar Tugas</h3>
                        
                        <a href="{{ route('tasks.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent 
                                  rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                  hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 
                                  focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150">
                            Tambah Tugas Baru
                        </a>
                    </div>
                    
                    @if($tasks->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-secondary">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tugas</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Proyek</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Prioritas</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Durasi Estimasi</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Durasi AI</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tenggat</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-card divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-textlight">{{ $task->title }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($task->description, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-textlight">
                                                <a href="{{ route('projects.show', $task->project) }}" class="text-primary-600 dark:text-primary-400 hover:underline">
                                                    {{ $task->project->name }}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (strtolower($task->status) == 'completed')
                                                <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                    Completed
                                                </span>
                                            @elseif (strtolower($task->status) == 'in progress')
                                                <span class="inline-block bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                    In Progress
                                                </span>
                                            @else
                                                <span class="inline-block bg-gray-100 text-gray-800 dark:bg-gray-700/50 dark:text-gray-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-900 dark:text-textlight">
                                                @if($task->priority == 'high')
                                                    <span class="bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300 text-xs font-medium px-2 py-0.5 rounded">Tinggi</span>
                                                @elseif($task->priority == 'medium')
                                                    <span class="bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 text-xs font-medium px-2 py-0.5 rounded">Sedang</span>
                                                @else
                                                    <span class="bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300 text-xs font-medium px-2 py-0.5 rounded">Rendah</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $task->estimated_hours ? $task->estimated_hours . 'h' : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $task->ai_predicted_hours ? $task->ai_predicted_hours . 'h' : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">Belum ada tugas yang ditugaskan ke Anda.</p>
                            <a href="{{ route('tasks.create') }}" 
                               class="mt-4 inline-block bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                                Buat Tugas Pertama Anda
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
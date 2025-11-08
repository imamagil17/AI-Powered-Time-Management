<x-app-layout>
    <!-- Custom CSS for Animations (Sama seperti Dashboard) -->
    <style>
        @keyframes gracefulFadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-graceful {
            animation: gracefulFadeInUp 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            opacity: 0; /* Mulai transparan agar tidak 'flash' */
        }
    </style>

    {{-- Bagian Header Halaman --}}
    <x-slot name="header">
        <!-- 👇 Animasi ditambahkan di sini -->
        <div class="animate-graceful" style="animation-delay: 0s;">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-textlight leading-tight">
                {{ __('Proyek Saya') }}
            </h2>
        </div>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12 bg-gray-50 dark:bg-secondary">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-card overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-textlight">
                    
                    {{-- Tombol Tambah Proyek --}}
                    <!-- 👇 Animasi ditambahkan di sini -->
                    <a href="{{ route('projects.create') }}" class="mb-6 inline-flex items-center px-4 py-2 
                                   bg-primary-600 border border-transparent 
                                   rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                   hover:bg-primary-700 
                                   focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 
                                   dark:focus:ring-offset-secondary
                                   transition ease-in-out duration-150
                                   animate-graceful" 
                       style="animation-delay: 0.1s;">
                        Tambah Proyek Baru
                    </a>

                    {{-- Grid untuk Kartu Proyek --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        {{-- Loop through actual project data --}}
                        @forelse ($projects as $project)
                            
                            <!-- 👇 Animasi ditambahkan di sini dengan delay bertingkat (staggered) -->
                            <div class="bg-white dark:bg-secondary border border-gray-200 dark:border-gray-700 rounded-lg shadow-md p-5 flex flex-col justify-between
                                        animate-graceful"
                                 style="animation-delay: {{ 0.2 + ($loop->index * 0.1) }}s;">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-textlight mb-2">
                                        {{ $project->name }}
                                    </h3>

                                    <div class="mb-3">
                                        @if (strtolower($project->status) == 'completed')
                                            <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                Completed
                                            </span>
                                        @elseif (strtolower($project->status) == 'in progress')
                                            <span class="inline-block bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                In Progress
                                            </span>
                                        @else
                                            <span class="inline-block bg-gray-100 text-gray-800 dark:bg-gray-700/50 dark:text-gray-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Progress Bar (calculate based on tasks) --}}
                                    <div class="mb-2">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Progres</span>
                                            @php
                                                $totalTasks = $project->tasks->count();
                                                $completedTasks = $project->tasks->where('status', 'completed')->count();
                                                $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                                            @endphp
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ number_format($progress, 0) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-primary-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>

                                    @if($project->due_date)
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                            Tenggat: {{ \Carbon\Carbon::parse($project->due_date)->format('d M Y') }}
                                        </p>
                                    @endif
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="flex justify-between">
                                    <a href="{{ route('projects.show', $project) }}" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                        Lihat Detail
                                    </a>
                                    <a href="{{ route('projects.edit', $project) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Anda belum memiliki proyek.</p>
                                <a href="{{ route('projects.create') }}" class="mt-4 inline-block bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                                    Buat Proyek Pertama Anda
                                </a>
                            </div>
                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    {{-- Bagian Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proyek Saya') }}
        </h2>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Tombol Tambah Proyek (Nanti akan dibuat) --}}
                    <a href="#" class="mb-6 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Tambah Proyek Baru
                    </a>

                    {{-- Grid untuk Kartu Proyek --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        {{-- Kita loop data palsu yang kita kirim dari route --}}
                        @foreach ($projects as $project)
                            
                            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">
                                    {{ $project['name'] }}
                                </h3>

                                <div class="mb-3">
                                    @if ($project['status'] == 'Completed')
                                        <span class="inline-block bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Completed
                                        </span>
                                    @elseif ($project['status'] == 'In Progress')
                                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            In Progress
                                        </span>
                                    @else
                                        <span class="inline-block bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Pending
                                        </span>
                                    @endif
                                </div>

                                {{-- Progress Bar --}}
                                <div class="mb-2">
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Progres</span>
                                        <span class="text-sm font-medium text-gray-700">{{ $project['progress'] }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $project['progress'] }}%"></div>
                                    </div>
                                </div>

                                <p class="text-sm text-gray-500 mb-4">
                                    Tenggat: {{ \Carbon\Carbon::parse($project['due_date'])->format('d M Y') }}
                                </p>

                                {{-- Tombol Aksi --}}
                                <a href="#" class="font-medium text-blue-600 hover:underline">
                                    Lihat Detail
                                </a>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
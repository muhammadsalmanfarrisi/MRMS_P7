<x-app-layout>
    <x-slot name="header">
        Lapor Kerusakan Mesin/Alat
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border dark:border-gray-700">

                <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Mesin/Alat yang
                            Rusak *</label>
                        <input type="text" name="damaged_tool" placeholder="Contoh: Mesin Potong SP7"
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-blue-500"
                            required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Deskripsi Kerusakan
                            *</label>
                        <textarea name="description" rows="3" placeholder="Jelaskan detail kerusakannya secara rinci..."
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-blue-500"
                            required></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Penyebab
                            (Opsional)</label>
                        <textarea name="cause" rows="2" placeholder="Jika diketahui, apa penyebabnya?"
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-blue-500"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="p-4 border dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-800/50">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-camera-fill mr-1"></i> Unggah Foto (Opsional)
                            </label>
                            <input type="file" name="photo" accept="image/*"
                                class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                            <p class="text-xs text-gray-500 mt-1">Maks. 5MB (JPG, PNG)</p>
                        </div>

                        <div class="p-4 border dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-800/50">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-camera-video-fill mr-1"></i> Unggah Video (Opsional)
                            </label>
                            <input type="file" name="video" accept="video/mp4,video/quicktime"
                                class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                            <p class="text-xs text-gray-500 mt-1">Maks. 20MB (MP4)</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6 pt-4 border-t dark:border-gray-700">
                        <a href="{{ route('reports.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-5 rounded-lg transition-colors">Batal</a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-colors shadow-md">Kirim
                            Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

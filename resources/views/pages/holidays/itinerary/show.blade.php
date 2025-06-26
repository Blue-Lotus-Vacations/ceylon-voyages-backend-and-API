<x-app-layout>
    <div class="p-2 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-6">

                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('holiday.itenery-index', $holiday) }}" 
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                        ← Back to Itineraries
                    </a>
                </div>

                <!-- Itinerary Title -->
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $itinerary['day_title'] }}</h2>

                <!-- Itinerary Description -->
                <p class="text-gray-700 dark:text-gray-300 mb-6">{{ $itinerary['day_description'] }}</p>

                <!-- Image Gallery -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse ($itinerary['day_images'] as $image)
                        <div class="relative group">
                            <img src="{{ $image['full_path'] }}" 
                                 class="w-full h-48 object-cover rounded shadow-md" 
                                 alt="Itinerary Image">
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 col-span-2">No images available.</p>
                    @endforelse
                </div>

              

            </div>
        </div>
    </div>
</x-app-layout>

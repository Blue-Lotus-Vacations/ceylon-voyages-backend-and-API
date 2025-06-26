 @props([
    'holiday',
    'itinerary_cards',
    'cost_includes',
    'multicities',
    ])

<div id="create-holiday-accordion-collapse" data-accordion="collapse">
    <h2 id="create-holiday-accordion-collapse-heading-1">
        <button type="button"
            class="flex justify-between items-center py-4 px-4 w-full font-medium leading-none text-left text-gray-900 bg-gray-50 sm:px-5 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600"
            data-accordion-target="#create-holiday-accordion-collapse-body-1" aria-expanded="true"
            aria-controls="create-holiday-accordion-collapse-body-1">
            <span>Holiday Information</span>
            <svg data-accordion-icon="" class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>

    <div id="create-holiday-accordion-collapse-body-1" class="hidden"
        aria-labelledby="create-holiday-accordion-collapse-heading-1">
        <div class="py-4 border-gray-200 sm:py-5 dark:border-gray-700">
            <div class="space-y-4 sm:space-y-6">
                <!-- holiday name, price, no of nights -->
                <div class="space-y-4 sm:flex sm:space-x-4 sm:space-y-0">

                    <!-- Holiday -->
                    <div class="w-full">
                        <label for="deal_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Holiday
                            Name</label>
                        <input type="text" value="{{ old('deal_name', $holiday->deal_name ?? '') }}"
                            name="deal_name" id="deal_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type holiday name">
                        <x-input-error :messages="$errors->get('deal_name')" class="mt-2" />
                    </div>

                    <!-- Deal name  -->
                    <div class="w-full">
                        <label for="dealname"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" value="{{ old('price', $holiday->price ?? '') }}"
                            name="price" id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type price">
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- Price -->
                    <div class="w-full">
                        <label for="price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No of Nights</label>
                        <input type="text" value="{{ old('no_of_nights', $holiday->no_of_nights ?? '') }}" name="no_of_nights"
                            id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type no of nights">
                        <x-input-error :messages="$errors->get('no_of_nights')" class="mt-2" />
                    </div>

                </div>

                <!-- holiday description -->
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Holiday Description</label>
                        <div
                            class="mb-4 w-full bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <div class="py-2 px-4 bg-gray-50 rounded-b-lg dark:bg-gray-700">
                                <textarea name="description" id="description" rows="10"
                                    class="block px-0 w-full text-sm text-gray-800 bg-gray-50 border-0 dark:bg-gray-700 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Write Holiday Description">{{ old('description', $holiday->description ?? '') }}</textarea>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>

                <!-- itinerary card -->
                <div class="py-4 border-gray-200 sm:py-5 dark:border-gray-700">
                    <div class="bg-white p-4 mt-4">
                        <div class="mb-4">
                            <h1 class="font-bold text-gray-700 text-xl">Itinerary Section</h1>
                            <hr class="my-2">
                        </div>

                        <!-- Input for Adding Itinerary Cards -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="itinerary-card-description" class="text-gray-600 text-sm font-medium">Itinerary Description</label>
                                <input id="itinerary-card-description" type="text"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter itinerary description">
                            </div>
                        </div>

                        <!-- Add Itinerary Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md" id="add-itinerary-card">Add Itinerary</button>
                        </div>

                        <!-- Itinerary Card Details Section -->
                        <div class="mt-6 space-y-4" id="itinerary-card-details">
                            <!-- Dynamic itinerary cards will appear here -->
                        </div>

                        <!-- Hidden input to store JSON -->
                        <input type="hidden" id="itinerary-cards-json" name="itinerary_cards">
                    </div>
                </div>

                <!-- itinerary description -->
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <label for="itinerary_description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Itinerary Description</label>
                        <div
                            class="mb-4 w-full bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <div class="py-2 px-4 bg-gray-50 rounded-b-lg dark:bg-gray-700">
                                <textarea name="itinerary_description" id="itinerary_description" rows="10"
                                    class="block px-0 w-full text-sm text-gray-800 bg-gray-50 border-0 dark:bg-gray-700 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Write Itinerary Description">{{ old('itinerary_description', $holiday->itinerary_description ?? '') }}</textarea>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('itinerary_description')" class="mt-2" />
                    </div>
                </div>


                <!-- cost inclusion description -->
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <label for="cost_includes_description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cost Includes Description</label>
                        <div
                            class="mb-4 w-full bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <div class="py-2 px-4 bg-gray-50 rounded-b-lg dark:bg-gray-700">
                                <textarea name="cost_includes_description" id="cost_includes_description" rows="10"
                                    class="block px-0 w-full text-sm text-gray-800 bg-gray-50 border-0 dark:bg-gray-700 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Cost Inclusions Description">{{ old('cost_includes_description', $holiday->cost_includes_description ?? '') }}</textarea>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('cost_includes_description')" class="mt-2" />
                    </div>
                </div>


                <!-- cost include -->
                <div class="py-4 border-gray-200 sm:py-5 dark:border-gray-700">
                    <div class="bg-white p-4 mt-4">
                        <div class="mb-4">
                            <h1 class="font-bold text-gray-700 text-xl">Cost Includes Section</h1>
                            <hr class="my-2">
                        </div>

                        <!-- Input for Adding Cost Includes -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="cost-includes-description" class="text-gray-600 text-sm font-medium">Cost Includes Description</label>
                                <input id="cost-includes-description" type="text"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter cost includes description">
                            </div>
                        </div>

                        <!-- Add Cost Includes Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md" id="add-cost-includes">Add Cost Include</button>
                        </div>

                        <!-- Cost Includes Details Section -->
                        <div class="mt-6 space-y-4" id="cost-includes-details">
                            <!-- Dynamic cost includes will appear here -->
                        </div>

                        <!-- Hidden input to store JSON -->
                        <input type="hidden" id="cost-includes-json" name="cost_includes">
                    </div>
                </div>

                <!-- tour map description -->
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <label for="tour_map_description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tour Map Description</label>
                        <div
                            class="mb-4 w-full bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <div class="py-2 px-4 bg-gray-50 rounded-b-lg dark:bg-gray-700">
                                <textarea name="tour_map_description" id="tour_map_description" rows="10"
                                    class="block px-0 w-full text-sm text-gray-800 bg-gray-50 border-0 dark:bg-gray-700 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Tour Map Description">{{ old('tour_map_description', $holiday->tour_map_description ?? '') }}</textarea>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('tour_map_description')" class="mt-2" />
                    </div>
                </div>

                <!-- tour map -->
                <div class="" id="multicity-cordinations">
                    <h2 class="text-lg font-semibold mb-2">Add Destination Coordinates</h2>

                    <!-- Section for adding coordinates -->
                    <div id="coordinates-section" class="space-y-4">
                        <!-- Existing coordinates will be added here dynamically -->
                    </div>

                    <!-- Form for adding a new coordinate -->
                    <div class="mt-4">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="latitude-multicity" class="text-gray-600 text-sm font-medium">Latitude</label>
                                <input id="latitude-multicity" type="text" class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500" placeholder="Enter Latitude">
                            </div>
                            <div>
                                <label for="longitude-multicity" class="text-gray-600 text-sm font-medium">Longitude</label>
                                <input id="longitude-multicity" type="text" class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500" placeholder="Enter Longitude">
                            </div>
                        </div>

                        <button type="button" id="add-coordinates" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded-md">Add Coordinates</button>
                    </div>

                    <!-- Hidden input to store coordinates JSON -->
                    <input type="hidden" id="coordinates-json" name="coordinates_json" value="[]">
                </div>

                <!-- aditional  information -->
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <label for="aditional_information"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Aditional Information</label>
                        <div
                            class="mb-4 w-full bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <div class="py-2 px-4 bg-gray-50 rounded-b-lg dark:bg-gray-700">
                                <textarea name="aditional_information" id="aditional_information" rows="10"
                                    class="block px-0 w-full text-sm text-gray-800 bg-gray-50 border-0 dark:bg-gray-700 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Aditional Information">{{ old('aditional_information', $holiday->aditional_information ?? '') }}</textarea>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('aditional_information')" class="mt-2" />
                    </div>
                </div>


                <!-- isfavorite -->
                <button id="starButton" type="button" class="btn btn-primary">
                    <i id="starIcon" class="fas fa-star"></i> <!-- Star icon -->
                    <input type="checkbox" hidden name="isFavorite" id="isFavorite">
                    Add to Favorites
                </button>

                

                @if (isset($holiday))
                @php

                $featured_images = [];
                foreach ($holiday->assets as $asset) {
                if ($asset->IsFeatured_image) {
                $featured_images[] = $asset;
                }
                }

                @endphp


                <!-- Featured Images  -->
                <div>
                    <div class="grid grid-cols-6 md:grid-cols-6 gap-3 p-4 place-items-center">
                        @foreach ($featured_images as $featured_image)
                        <div class=" text-center items-center justify-center w-full">
                            <img class="border-blue-100 hover:opacity-75 w-full h-48 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105"
                                src="{{ Storage::url($featured_image->file_path) }}">
                            <button class="mt-2" type="button"
                                onclick="DeleteImage('{{ $featured_image->id }}')">
                                <svg class="bg-red-100 mx-auto w-6 h-6 rounded text-red-800 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                </svg>
                            </button>
                        </div>
                        @endforeach

                        @if (count($featured_images) == 0)
                        <span class="text-red-900 p-2 rounded-2xl bg-red-100">No Featured Image </span>
                        @endif

                    </div>
                </div>

                @endif


                <div class="">
                    <label for="featured_image"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Featured Image</label>
                    <input type="file" name="featured_image" id="imageInput" accept="image/*">
                    <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />
                    <!-- Image preview container -->
                    <div id="imagePreview"></div>
                </div>



                <!-- gallery images  -->
                <div>
                    <div>
                        <label for="dropzone-file"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">holiday Images</label>

                        <button type="button" id="add-image-btn"
                            class="mt-2 px-2 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600">Add
                            Image</button>
                    </div>

                    <x-input-error :messages="$errors->get('')" class="mt-2" />
                    <div id="image-container" class="flex flex-wrap mt-2"></div>
                </div>

                @if (isset($holiday))
                <div>
                    <div class="grid grid-cols-6 md:grid-cols-6 gap-3 p-4 place-items-center">
                        @foreach ($holiday->assets as $asset)
                        @if (!$asset->IsFeatured_image)
                        <div class=" text-center items-center justify-center w-full">
                            <img class="border-blue-100 hover:opacity-75 w-full h-48 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105"
                                src="{{ Storage::url($asset->file_path) }}">
                            <button class="mt-2" type="button"
                                onclick="DeleteImage('{{ $asset->id }}')">
                                <svg class="bg-red-100 mx-auto w-6 h-6 rounded text-red-800 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                </svg>
                            </button>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif


            </div>
        </div>
    </div>



    <!-- itinerary card script -->
    <script>
        // Array to store all itinerary cards
        let itineraryCardsArray = @json($itinerary_cards ?? []);

        // Function to Add an Itinerary Card
        document.getElementById('add-itinerary-card').addEventListener('click', function() {
            const descriptionInput = document.getElementById('itinerary-card-description');
            const itineraryDescription = descriptionInput.value.trim();
            const itineraryId = Date.now(); // Unique ID

            if (!itineraryDescription) {
                alert('Please enter a description!');
                return;
            }

            const itineraryCard = {
                id: itineraryId,
                description: itineraryDescription,
            };

            itineraryCardsArray.push(itineraryCard);
            document.getElementById('itinerary-cards-json').value = JSON.stringify(itineraryCardsArray);

            const cardElement = document.createElement('div');
            cardElement.setAttribute('id', `itinerary-card-${itineraryId}`);
            cardElement.classList.add(
                'bg-gray-100',
                'p-4',
                'rounded-lg',
                'shadow-sm',
                'flex',
                'justify-between',
                'items-center',
                'hover:border-2',
                'hover:border-blue-500'
            );

            cardElement.innerHTML = `
            <div>
                <p class="text-gray-800">${itineraryDescription}</p>
            </div>
            <div>
                <button type="button" class="remove-itinerary-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-itinerary-id="${itineraryId}">Remove</button>
            </div>
        `;

            document.getElementById('itinerary-card-details').appendChild(cardElement);

            cardElement.querySelector('.remove-itinerary-btn').addEventListener('click', function() {
                if (confirm('Are you sure you want to remove this itinerary item?')) {
                    cardElement.remove();
                    itineraryCardsArray = itineraryCardsArray.filter((card) => card.id !== itineraryId);
                    document.getElementById('itinerary-cards-json').value = JSON.stringify(itineraryCardsArray);
                }
            });

            descriptionInput.value = '';
        });

        // Load existing itinerary cards on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (itineraryCardsArray.length > 0) {
                itineraryCardsArray.forEach((card) => {
                    const cardElement = document.createElement('div');
                    cardElement.setAttribute('id', `itinerary-card-${card.id}`);
                    cardElement.classList.add(
                        'bg-gray-100',
                        'p-4',
                        'rounded-lg',
                        'shadow-sm',
                        'flex',
                        'justify-between',
                        'items-center',
                        'hover:border-2',
                        'hover:border-blue-500'
                    );

                    cardElement.innerHTML = `
                    <div>
                        <p class="text-gray-800">${card.description}</p>
                    </div>
                    <div>
                        <button type="button" class="remove-itinerary-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-itinerary-id="${card.id}">Remove</button>
                    </div>
                `;

                    document.getElementById('itinerary-card-details').appendChild(cardElement);

                    cardElement.querySelector('.remove-itinerary-btn').addEventListener('click', function() {
                        if (confirm('Are you sure you want to remove this itinerary item?')) {
                            cardElement.remove();
                            itineraryCardsArray = itineraryCardsArray.filter((h) => h.id !== card.id);
                            document.getElementById('itinerary-cards-json').value = JSON.stringify(itineraryCardsArray);
                        }
                    });
                });

                document.getElementById('itinerary-cards-json').value = JSON.stringify(itineraryCardsArray);
            }
        });
    </script>

    <!-- cost includes -->
    <script>
        // Array to store all cost includes
        let costIncludesArray = @json($cost_includes ?? []);

        // Function to Add a Cost Include
        document.getElementById('add-cost-includes').addEventListener('click', function() {
            const descriptionInput = document.getElementById('cost-includes-description');
            const costIncludesDescription = descriptionInput.value.trim();
            const costIncludesId = Date.now(); // Unique ID

            if (!costIncludesDescription) {
                alert('Please enter a description!');
                return;
            }

            const costInclude = {
                id: costIncludesId,
                description: costIncludesDescription,
            };

            costIncludesArray.push(costInclude);
            document.getElementById('cost-includes-json').value = JSON.stringify(costIncludesArray);

            const cardElement = document.createElement('div');
            cardElement.setAttribute('id', `cost-includes-${costIncludesId}`);
            cardElement.classList.add(
                'bg-gray-100',
                'p-4',
                'rounded-lg',
                'shadow-sm',
                'flex',
                'justify-between',
                'items-center',
                'hover:border-2',
                'hover:border-blue-500'
            );

            cardElement.innerHTML = `
            <div>
                <p class="text-gray-800">${costIncludesDescription}</p>
            </div>
            <div>
                <button type="button" class="remove-cost-includes-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-cost-includes-id="${costIncludesId}">Remove</button>
            </div>
        `;

            document.getElementById('cost-includes-details').appendChild(cardElement);

            cardElement.querySelector('.remove-cost-includes-btn').addEventListener('click', function() {
                if (confirm('Are you sure you want to remove this item?')) {
                    cardElement.remove();
                    costIncludesArray = costIncludesArray.filter((item) => item.id !== costIncludesId);
                    document.getElementById('cost-includes-json').value = JSON.stringify(costIncludesArray);
                }
            });

            descriptionInput.value = '';
        });

        // Load existing cost includes on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (costIncludesArray.length > 0) {
                costIncludesArray.forEach((item) => {
                    const cardElement = document.createElement('div');
                    cardElement.setAttribute('id', `cost-includes-${item.id}`);
                    cardElement.classList.add(
                        'bg-gray-100',
                        'p-4',
                        'rounded-lg',
                        'shadow-sm',
                        'flex',
                        'justify-between',
                        'items-center',
                        'hover:border-2',
                        'hover:border-blue-500'
                    );

                    cardElement.innerHTML = `
                    <div>
                        <p class="text-gray-800">${item.description}</p>
                    </div>
                    <div>
                        <button type="button" class="remove-cost-includes-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-cost-includes-id="${item.id}">Remove</button>
                    </div>
                `;

                    document.getElementById('cost-includes-details').appendChild(cardElement);

                    cardElement.querySelector('.remove-cost-includes-btn').addEventListener('click', function() {
                        if (confirm('Are you sure you want to remove this item?')) {
                            cardElement.remove();
                            costIncludesArray = costIncludesArray.filter((i) => i.id !== item.id);
                            document.getElementById('cost-includes-json').value = JSON.stringify(costIncludesArray);
                        }
                    });
                });

                document.getElementById('cost-includes-json').value = JSON.stringify(costIncludesArray);
            }
        });
    </script>

    <!-- tour map -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Array to store all coordinates
            let coordinatesArray = @json($multicities ?? []); // Load existing coordinates from Laravel backend

            const coordinatesSection = document.getElementById('coordinates-section');
            const coordinatesJsonInput = document.getElementById('coordinates-json');

            // Function to render coordinates in the DOM
            const renderCoordinates = () => {
                coordinatesSection.innerHTML = ''; // Clear existing coordinates from the DOM
                coordinatesArray.forEach(coordinate => {
                    const coordinateDiv = document.createElement('div');
                    coordinateDiv.setAttribute('id', `coordinate-${coordinate.id}`);
                    coordinateDiv.classList.add('flex', 'justify-between', 'items-center', 'bg-gray-100', 'p-4', 'rounded-lg', 'shadow-sm', 'space-x-4');

                    coordinateDiv.innerHTML = `
                    <div>
                        <p class="text-sm text-gray-700"><strong>Latitude:</strong> ${coordinate.latitude}</p>
                        <p class="text-sm text-gray-700"><strong>Longitude:</strong> ${coordinate.longitude}</p>
                    </div>
                    <button type="button" class="remove-coordinate bg-red-500 text-white px-2 py-1 rounded-md" data-id="${coordinate.id}">Remove</button>
                `;

                    coordinatesSection.appendChild(coordinateDiv);

                    // Add event listener to the remove button
                    coordinateDiv.querySelector('.remove-coordinate').addEventListener('click', function() {
                        const id = parseInt(this.getAttribute('data-id'), 10);

                        // Remove the coordinate from the array
                        coordinatesArray = coordinatesArray.filter(coord => coord.id !== id);

                        // Update the hidden input
                        coordinatesJsonInput.value = JSON.stringify(coordinatesArray);

                        // Remove the coordinate from the DOM
                        document.getElementById(`coordinate-${id}`).remove();
                    });
                });

                // Update the hidden input with the JSON string
                coordinatesJsonInput.value = JSON.stringify(coordinatesArray);
            };

            // Render existing coordinates on page load
            renderCoordinates();

            // Add new coordinates to the list
            document.getElementById('add-coordinates').addEventListener('click', function() {
                const latitude = document.getElementById('latitude-multicity').value.trim();
                const longitude = document.getElementById('longitude-multicity').value.trim();

                // Validate input
                if (!latitude || isNaN(latitude) || !longitude || isNaN(longitude)) {
                    alert('Please enter valid numeric values for both latitude and longitude.');
                    return;
                }

                // Create a coordinate object
                const coordinate = {
                    id: Date.now(), // Unique ID for each coordinate
                    latitude: parseFloat(latitude),
                    longitude: parseFloat(longitude)
                };

                // Add coordinate to the array
                coordinatesArray.push(coordinate);

                // Render updated coordinates
                renderCoordinates();

                // Clear the input fields
                document.getElementById('latitude-multicity').value = '';
                document.getElementById('longitude-multicity').value = '';
            });
        });
    </script>

    <!-- is fav, image priview and delete  -->
    <script>
        function DeleteImage(id) {


            var url = "{{ route('assets.delete', ':asset_id') }}";
            url = url.replace(':asset_id', id);
            fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {

                    if (data.success) {
                        console.log(data);
                        window.location.reload();
                    }
                })
                .catch((error) => {
                    console.log('Error:', error);
                });

        }

        // Get the button and star icon element
        const starButton = document.getElementById('starButton');
        const starIcon = document.getElementById('starIcon');
        const isFavorite = document.getElementById('isFavorite');


        // Add click event listener to the button
        starButton.addEventListener('click', function() {
            // Toggle the 'active' class to change the color
            starIcon.classList.toggle('active');
            if (isFavorite.checked) {
                isFavorite.checked = false;
            } else {
                isFavorite.checked = true;
            }

        });


        // JavaScript to handle image selection and preview
        document.getElementById('imageInput').addEventListener('change', function(event) {
            var file = event.target.files[0]; // Get the selected file

            // Check if a file was selected
            if (file) {
                var reader = new FileReader(); // Create a new FileReader object

                // Define the FileReader onload function
                reader.onload = function(e) {
                    var imagePreview = document.getElementById('imagePreview');
                    imagePreview.innerHTML = ''; // Clear previous preview (if any)

                    var img = document.createElement('img'); // Create a new img element
                    img.src = e.target
                        .result; // Set the src attribute to the FileReader result (base64 data URL)
                    img.style.maxWidth = '100%'; // Set max width for the preview image
                    img.style.maxHeight = '200px'; // Set max height for the preview image
                    img.classList.add('flex', 'flex-col', 'justify-center', 'items-center', 'w-32', 'h-32',
                        'bg-gray-50', 'rounded-lg', 'border', 'border-gray-300', 'border-dashed',
                        'dark:hover:bg-bray-800', 'dark:bg-gray-700', 'hover:bg-gray-100',
                        'dark:border-gray-600', 'dark:hover:border-gray-500', 'dark:hover:bg-gray-600');

                    // Append the img element to the imagePreview container
                    imagePreview.appendChild(img);
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(file);
            }
        });
    </script>


    <!-- gallery images -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var addImageBtn = document.getElementById('add-image-btn');
            var imageCount = 0;

            addImageBtn.addEventListener('click', function() {
                var fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.name = 'holiday_images[]';
                fileInput.multiple = false;
                fileInput.classList.add('hidden');
                fileInput.addEventListener('change', function() {
                    previewImage(this, imageCount, fileInput);
                });




                fileInput.click();

                imageCount++;
            });

            function previewImage(input, imageCount, fileInput) {
                var imageContainer = document.getElementById('image-container');

                var label = document.createElement('label');
                label.htmlFor = 'image-upload-' + imageCount;
                label.classList.add('flex', 'flex-col', 'justify-center', 'items-center', 'w-32', 'h-32', 'bg-gray-50', 'rounded-lg', 'border', 'border-gray-300', 'border-dashed', 'dark:hover:bg-bray-800', 'dark:bg-gray-700', 'hover:bg-gray-100', 'dark:border-gray-600', 'dark:hover:border-gray-500', 'dark:hover:bg-gray-600');


                label.appendChild(fileInput);
                imageContainer.appendChild(label);
                var file = input.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-full', 'h-full', 'object-cover', 'rounded-lg');
                    input.parentNode.insertBefore(img, input.nextSibling);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@props([
'destination_categories',
])

<div id="create-holiday-accordion-collapse" data-accordion="collapse">
    <h2 id="create-holiday-accordion-collapse-heading-1">
        <button type="button"
            class="flex justify-between items-center py-4 px-4 w-full font-medium leading-none text-left text-gray-900 bg-gray-50 sm:px-5 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600"
            data-accordion-target="#create-holiday-accordion-collapse-body-1" aria-expanded="true"
            aria-controls="create-holiday-accordion-collapse-body-1">
            <span>Destination Information</span>
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

                    <!-- destination name -->
                    <div class="w-full">
                        <label for="destination_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination Name</label>
                        <input type="text" value="{{ old('destination_name', $destination->destination_name ?? '') }}"
                            name="destination_name" id="destination_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type Destination Name">
                        <x-input-error :messages="$errors->get('destination_name')" class="mt-2" />
                    </div>


                    <!-- Category -->
                    <div class="w-full">
                        <label for="destination_category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category </label>
                        <select oninput="getSelectedCategory()" id="destination_category" name="destination_category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select One</option>
                            @foreach ($destination_categories as $destination_category)
                            <option value="{{ $destination_category->id }}"
                                {{ old('destination_category', isset($destination) ? $destination->destination_category : null) == $destination_category->id ? 'selected' : '' }}>
                                {{ $destination_category->destination_category_name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('destination_category')" class="mt-2" />
                    </div>

                </div>


                <!-- destination card summary -->
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <label for="destination_card_summary"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination Card Summary</label>
                        <div
                            class="mb-4 w-full bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <div class="py-2 px-4 bg-gray-50 rounded-b-lg dark:bg-gray-700">
                                <textarea name="destination_card_summary" id="destination_card_summary" rows="10"
                                    class="block px-0 w-full text-sm text-gray-800 bg-gray-50 border-0 dark:bg-gray-700 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Write Destination Card Description">{{ old('destination_card_summary', $destination->destination_card_summary ?? '') }}</textarea>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('destination_card_summary')" class="mt-2" />
                    </div>
                </div>



                @if (isset($destination))
                @php

                $featured_images = [];
                foreach ($destination->assets as $asset) {
                if ($asset->IsFeatured_image) {
                $featured_images[] = $asset;
                }
                }

                @endphp
                @endif


                <!-- highlights  -->
                @if (isset($destination))
                <div>
                    <div class="grid grid-cols-6 md:grid-cols-6 gap-3 p-4 place-items-center">
                        @foreach ($destination->assets as $asset)
                        @if(!$asset->IsFeatured_image && $asset->attachment_type == 'Destination Highlight Image')
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

                <div class="">
                    <label for="highlight_image"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Highlight Image</label>
                    <input type="file" name="highlight_image" id="imageInput" accept="image/*">
                    <x-input-error :messages="$errors->get('highlight_image')" class="mt-2" />
                    <!-- Image preview container -->
                    <div id="imagePreview"></div>
                </div>


                <!-- highlights description section -->
                <div class="py-4 border-gray-200 sm:py-5 dark:border-gray-700">
                    <div class="bg-white p-4 mt-4">
                        <div class="mb-4">
                            <h1 class="font-bold text-gray-700 text-xl">Highlights Section</h1>
                            <hr class="my-2">
                        </div>

                        <!-- Input for Adding Highlights -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="highlight-description" class="text-gray-600 text-sm font-medium">Highlight Description</label>
                                <input id="highlight-description" type="text"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter highlight description">
                            </div>
                        </div>

                        <!-- Add Highlight Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md" id="add-highlight">Add Highlight</button>
                        </div>

                        <!-- Highlights Card Details Section -->
                        <div class="mt-6 space-y-4" id="highlight-details">
                            <!-- Dynamic highlights will appear here -->
                        </div>

                        <!-- Hidden input to store JSON -->
                        <input type="hidden" id="highlights-json" name="highlights">
                    </div>
                </div>



                @if (isset($destination))
                <div>
                    <div class="grid grid-cols-6 md:grid-cols-6 gap-3 p-4 place-items-center">
                        @foreach ($destination->assets as $asset)
                        @if(!$asset->IsFeatured_image && $asset->attachment_type == 'Destination Visit Time Image')
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

                <div class="">
                    <label for="visit_time_image"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Best Time To Image</label>
                    <input type="file" name="visit_time_image" id="imageInput" accept="image/*">
                    <x-input-error :messages="$errors->get('visit_time_image')" class="mt-2" />
                    <!-- Image preview container -->
                    <div id="imagePreview"></div>
                </div>

                <!-- best time to visit -->
                <div class="py-4 border-gray-200 sm:py-5 dark:border-gray-700">
                    <div class="bg-white p-4 mt-4">
                        <div class="mb-4">
                            <h1 class="font-bold text-gray-700 text-xl">Best Time To Visit Section</h1>
                            <hr class="my-2">
                        </div>

                        <!-- Input for Adding Visit Time -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="visit-time" class="text-gray-600 text-sm font-medium">Best Time To Visit</label>
                                <input id="visit-time" type="text"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter time to visit">
                            </div>
                        </div>

                        <!-- Add Visit Time Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-indigo-500 text-white px-4 py-2 rounded-md" id="add-visit-time">Add Best Time To Visit</button>
                        </div>

                        <!-- Visit Time Card Details Section -->
                        <div class="mt-6 space-y-4" id="visit-time-details">
                            <!-- Dynamic visit times will appear here -->
                        </div>

                        <!-- Hidden input to store JSON -->
                        <input type="hidden" id="visit-time-json" name="visit_times">
                    </div>
                </div>




                <!-- worth a visit -->
                <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                    <!-- Worth a Visit Details Section -->
                    <div class="bg-white p-4 mt-4">
                        <div class="space-y-4" id="worth-visit-details">
                            <!-- Existing Worth a Visit Items Will Be Rendered Here -->
                        </div>
                    </div>

                    <!-- Add More Worth a Visit -->
                    <div class="bg-white p-4 mt-4">
                        <h2 class="font-bold text-gray-700 text-xl mb-4">Add Worth a Visit</h2>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="worth_visit_heading" class="text-gray-600 text-sm font-medium">Heading</label>
                                <input id="worth_visit_heading" type="text"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Heading">
                            </div>

                            <div>
                                <label for="worth_visit_description" class="text-gray-600 text-sm font-medium">Description</label>
                                <textarea id="worth_visit_description" rows="3"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Write description here"></textarea>
                            </div>

                            <div>
                                <label for="worth_visit_image" class="text-gray-600 text-sm font-medium">Image</label>
                                <input id="worth_visit_image" type="file" name="worth_visit_image[]"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500">
                            </div>
                        </div>

                        <!-- Add Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-md" id="add-worth-visit">Add Worth a Visit</button>
                        </div>
                    </div>
                </div>

                <!-- Hidden input for storing JSON -->
                <input type="hidden" name="worth_visit_json" id="worth_visit_json">


                <!-- food section -->
                <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                    <!-- Food Details Section -->
                    <div class="bg-white p-4 mt-4">
                        <div class="space-y-4" id="food-details">
                            <!-- Existing Food Items Will Be Rendered Here -->
                        </div>
                    </div>

                    <!-- Add More Food -->
                    <div class="bg-white p-4 mt-4">
                        <h2 class="font-bold text-gray-700 text-xl mb-4">Add Food</h2>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="food_heading" class="text-gray-600 text-sm font-medium">Food Name / Title</label>
                                <input id="food_heading" type="text"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Eg: Traditional Rice & Curry">
                            </div>

                            <div>
                                <label for="food_description" class="text-gray-600 text-sm font-medium">Description</label>
                                <textarea id="food_description" rows="3"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Write about the food item here"></textarea>
                            </div>

                            <div>
                                <label for="food_image" class="text-gray-600 text-sm font-medium">Image</label>
                                <input id="food_image" type="file" name="food_image[]"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500">
                            </div>
                        </div>

                        <!-- Add Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-green-600 text-white px-4 py-2 rounded-md" id="add-food">Add Food</button>
                        </div>
                    </div>
                </div>

                <!-- Hidden input for storing JSON -->
                <input type="hidden" name="food_json" id="food_json">


                <!-- culture & traditions -->
                @if (isset($destination))
                <div>
                    <div class="grid grid-cols-6 md:grid-cols-6 gap-3 p-4 place-items-center">
                        @foreach ($destination->assets as $asset)
                        @if(!$asset->IsFeatured_image && $asset->attachment_type == 'Destination Culture Image')
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

                <div class="">
                    <label for="culture_image"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Culture Image</label>
                    <input type="file" name="culture_image" id="imageInput" accept="image/*">
                    <x-input-error :messages="$errors->get('culture_image')" class="mt-2" />
                    <!-- Image preview container -->
                    <div id="imagePreview"></div>
                </div>


                


                <!-- Culture Section -->
                <div class="py-4 border-gray-200 sm:py-5 dark:border-gray-700">
                    <div class="bg-white p-4 mt-4">
                        <div class="mb-4">
                            <h1 class="font-bold text-gray-700 text-xl">Culture Section</h1>
                            <hr class="my-2">
                        </div>

                        <!-- Input for Adding Culture Item -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="culture-input" class="text-gray-600 text-sm font-medium">Culture</label>
                                <input id="culture-input" type="text"
                                    class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter culture description or aspect">
                            </div>
                        </div>

                        <!-- Add Culture Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-purple-600 text-white px-4 py-2 rounded-md" id="add-culture">Add Culture</button>
                        </div>

                        <!-- Culture Card Details Section -->
                        <div class="mt-6 space-y-4" id="culture-details">
                            <!-- Dynamic culture entries will appear here -->
                        </div>

                        <!-- Hidden input to store JSON -->
                        <input type="hidden" id="culture-json" name="culture">
                    </div>
                </div>


                <!-- map image -->
                 @if (isset($destination))
                <div>
                    <div class="grid grid-cols-6 md:grid-cols-6 gap-3 p-4 place-items-center">
                        @foreach ($destination->assets as $asset)
                        @if(!$asset->IsFeatured_image && $asset->attachment_type == 'Destination Map Image')
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

                <div class="">
                    <label for="map_image"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Map Image</label>
                    <input type="file" name="map_image" id="imageInput" accept="image/*">
                    <x-input-error :messages="$errors->get('map_image')" class="mt-2" />
                    <!-- Image preview container -->
                    <div id="imagePreview"></div>
                </div>



                @if (isset($destination))
                <!-- Featured Images  -->
                <div>
                    <div class="grid grid-cols-6 md:grid-cols-6 gap-3 p-4 place-items-center">
                        @foreach ($featured_images as $featured_image)
                        <div class=" text-center items-center justify-center w-full">
                            <img class="border-blue-100 hover:opacity-75 w-full h-48 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105"
                                src="{{ url($featured_image->file_path) }}">
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




                <!-- isfavorite -->
                <button id="starButton" type="button" class="btn btn-primary">
                    <i id="starIcon" class="fas fa-star"></i> <!-- Star icon -->
                    <input type="checkbox" hidden name="isFavorite" id="isFavorite">
                    Add to Favorites
                </button>


            </div>
        </div>
    </div>



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
    </script>


    <!-- highlights -->
    <script>
        // Array to store all highlight entries
        let highlightsArray = @json($highlights ?? []);

        // Add new highlight
        document.getElementById('add-highlight').addEventListener('click', function() {
            const input = document.getElementById('highlight-description');
            const description = input.value.trim();
            const highlightId = Date.now(); // Unique ID

            if (!description) {
                alert('Please enter a highlight description!');
                return;
            }

            const highlight = {
                id: highlightId,
                description: description,
            };

            highlightsArray.push(highlight);
            document.getElementById('highlights-json').value = JSON.stringify(highlightsArray);

            const card = document.createElement('div');
            card.setAttribute('id', `highlight-${highlightId}`);
            card.classList.add(
                'bg-green-100',
                'p-4',
                'rounded-lg',
                'shadow-sm',
                'flex',
                'justify-between',
                'items-center',
                'hover:border-2',
                'hover:border-green-500'
            );

            card.innerHTML = `
            <div>
                <p class="text-gray-800">${description}</p>
            </div>
            <div>
                <button type="button" class="remove-highlight-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-highlight-id="${highlightId}">Remove</button>
            </div>
        `;

            document.getElementById('highlight-details').appendChild(card);

            card.querySelector('.remove-highlight-btn').addEventListener('click', function() {
                if (confirm('Are you sure you want to remove this highlight?')) {
                    card.remove();
                    highlightsArray = highlightsArray.filter(h => h.id !== highlightId);
                    document.getElementById('highlights-json').value = JSON.stringify(highlightsArray);
                }
            });

            input.value = '';
        });

        // Load existing highlights on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (highlightsArray.length > 0) {
                highlightsArray.forEach((highlight) => {
                    const card = document.createElement('div');
                    card.setAttribute('id', `highlight-${highlight.id}`);
                    card.classList.add(
                        'bg-green-100',
                        'p-4',
                        'rounded-lg',
                        'shadow-sm',
                        'flex',
                        'justify-between',
                        'items-center',
                        'hover:border-2',
                        'hover:border-green-500'
                    );

                    card.innerHTML = `
                    <div>
                        <p class="text-gray-800">${highlight.description}</p>
                    </div>
                    <div>
                        <button type="button" class="remove-highlight-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-highlight-id="${highlight.id}">Remove</button>
                    </div>
                `;

                    document.getElementById('highlight-details').appendChild(card);

                    card.querySelector('.remove-highlight-btn').addEventListener('click', function() {
                        if (confirm('Are you sure you want to remove this highlight?')) {
                            card.remove();
                            highlightsArray = highlightsArray.filter(h => h.id !== highlight.id);
                            document.getElementById('highlights-json').value = JSON.stringify(highlightsArray);
                        }
                    });
                });

                document.getElementById('highlights-json').value = JSON.stringify(highlightsArray);
            }
        });
    </script>

    <!-- best time to visit -->
    <script>
        // Array to store all visit time entries
        let visitTimeArray = @json($visit_times ?? []);

        // Add new visit time
        document.getElementById('add-visit-time').addEventListener('click', function() {
            const input = document.getElementById('visit-time');
            const timeValue = input.value.trim();
            const visitTimeId = Date.now(); // Unique ID

            if (!timeValue) {
                alert('Please enter a visit time!');
                return;
            }

            const visitTime = {
                id: visitTimeId,
                time: timeValue,
            };

            visitTimeArray.push(visitTime);
            document.getElementById('visit-time-json').value = JSON.stringify(visitTimeArray);

            const card = document.createElement('div');
            card.setAttribute('id', `visit-time-${visitTimeId}`);
            card.classList.add(
                'bg-indigo-100',
                'p-4',
                'rounded-lg',
                'shadow-sm',
                'flex',
                'justify-between',
                'items-center',
                'hover:border-2',
                'hover:border-indigo-500'
            );

            card.innerHTML = `
            <div>
                <p class="text-gray-800">${timeValue}</p>
            </div>
            <div>
                <button type="button" class="remove-visit-time-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-id="${visitTimeId}">Remove</button>
            </div>
        `;

            document.getElementById('visit-time-details').appendChild(card);

            card.querySelector('.remove-visit-time-btn').addEventListener('click', function() {
                if (confirm('Are you sure you want to remove this visit time?')) {
                    card.remove();
                    visitTimeArray = visitTimeArray.filter(item => item.id !== visitTimeId);
                    document.getElementById('visit-time-json').value = JSON.stringify(visitTimeArray);
                }
            });

            input.value = '';
        });

        // Load existing visit times on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (visitTimeArray.length > 0) {
                visitTimeArray.forEach((item) => {
                    const card = document.createElement('div');
                    card.setAttribute('id', `visit-time-${item.id}`);
                    card.classList.add(
                        'bg-indigo-100',
                        'p-4',
                        'rounded-lg',
                        'shadow-sm',
                        'flex',
                        'justify-between',
                        'items-center',
                        'hover:border-2',
                        'hover:border-indigo-500'
                    );

                    card.innerHTML = `
                    <div>
                        <p class="text-gray-800">${item.time}</p>
                    </div>
                    <div>
                        <button type="button" class="remove-visit-time-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-id="${item.id}">Remove</button>
                    </div>
                `;

                    document.getElementById('visit-time-details').appendChild(card);

                    card.querySelector('.remove-visit-time-btn').addEventListener('click', function() {
                        if (confirm('Are you sure you want to remove this visit time?')) {
                            card.remove();
                            visitTimeArray = visitTimeArray.filter(t => t.id !== item.id);
                            document.getElementById('visit-time-json').value = JSON.stringify(visitTimeArray);
                        }
                    });
                });

                document.getElementById('visit-time-json').value = JSON.stringify(visitTimeArray);
            }
        });
    </script>


    <!-- Worth a Visit  -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let worthVisitArray = @json($worth_visit ?? []);

            const updateHiddenInput = () => {
                document.getElementById('worth_visit_json').value = JSON.stringify(worthVisitArray);
            };

            const renderCard = (item) => {
                const card = document.createElement('div');
                card.setAttribute('id', `worth-visit-${item.id}`);
                card.classList.add('bg-[#F7F9FC]', 'p-4', 'rounded-lg', 'shadow-sm', 'flex', 'justify-between', 'items-center', 'hover:border-2', 'hover:border-blue-500');

                card.innerHTML = `
                <div>
                    <dl class="grid grid-cols-2 gap-x-8 gap-y-2">
                        <div><span class="font-semibold">Heading:</span> ${item.heading}</div>
                        <div><span class="font-semibold">Description:</span> ${item.description}</div>
                        <div><span class="font-semibold">Image:</span> <img src="${item.full_path || item.image_base64}" alt="Image" class="w-20 h-20 object-cover rounded-md"></div>
                    </dl>
                </div>
                <div>
                    <button type="button" class="remove-worth-btn bg-red-500 text-white rounded-full px-2 py-1 hover:bg-red-400" data-id="${item.id}">Remove</button>
                </div>
            `;

                document.getElementById('worth-visit-details').appendChild(card);

                card.querySelector('.remove-worth-btn').addEventListener('click', function() {
                    if (confirm('Are you sure you want to remove this entry?')) {
                        card.remove();
                        worthVisitArray = worthVisitArray.filter(w => w.id !== item.id);
                        updateHiddenInput();
                    }
                });
            };

            // Load existing data on page load
            if (worthVisitArray.length > 0) {
                worthVisitArray.forEach(renderCard);
                updateHiddenInput();
            }

            // Add new item
            document.getElementById('add-worth-visit').addEventListener('click', function() {
                const heading = document.getElementById('worth_visit_heading').value.trim();
                const description = document.getElementById('worth_visit_description').value.trim();
                const imageFile = document.getElementById('worth_visit_image').files[0];
                const id = Date.now();

                if (!heading || !description || !imageFile) {
                    alert('Please fill all the fields!');
                    return;
                }

                const reader = new FileReader();

                reader.onloadend = function() {
                    const base64Image = reader.result;

                    const item = {
                        id,
                        heading,
                        description,
                        image_base64: base64Image
                    };

                    worthVisitArray.push(item);
                    updateHiddenInput();
                    renderCard(item);

                    // Reset inputs
                    document.getElementById('worth_visit_heading').value = '';
                    document.getElementById('worth_visit_description').value = '';
                    document.getElementById('worth_visit_image').value = '';
                };

                reader.readAsDataURL(imageFile);
            });
        });
    </script>

    <!-- food  -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let foodArray = @json($food ?? []);

            const updateFoodInput = () => {
                document.getElementById('food_json').value = JSON.stringify(foodArray);
            };

            const renderFoodCard = (item) => {
                const card = document.createElement('div');
                card.setAttribute('id', `food-${item.id}`);
                card.classList.add('bg-[#F7F9FC]', 'p-4', 'rounded-lg', 'shadow-sm', 'flex', 'justify-between', 'items-center', 'hover:border-2', 'hover:border-green-500');

                card.innerHTML = `
                <div>
                    <dl class="grid grid-cols-2 gap-x-8 gap-y-2">
                        <div><span class="font-semibold">Food:</span> ${item.heading}</div>
                        <div><span class="font-semibold">Description:</span> ${item.description}</div>
                        <div><span class="font-semibold">Image:</span> <img src="${item.full_path || item.image_base64}" alt="Image" class="w-20 h-20 object-cover rounded-md"></div>
                    </dl>
                </div>
                <div>
                    <button type="button" class="remove-food-btn bg-red-500 text-white rounded-full px-2 py-1 hover:bg-red-400" data-id="${item.id}">Remove</button>
                </div>
            `;

                document.getElementById('food-details').appendChild(card);

                card.querySelector('.remove-food-btn').addEventListener('click', function() {
                    if (confirm('Are you sure you want to remove this food item?')) {
                        card.remove();
                        foodArray = foodArray.filter(f => f.id !== item.id);
                        updateFoodInput();
                    }
                });
            };

            // Load existing data on page load
            if (foodArray.length > 0) {
                foodArray.forEach(renderFoodCard);
                updateFoodInput();
            }

            // Add new food item
            document.getElementById('add-food').addEventListener('click', function() {
                const heading = document.getElementById('food_heading').value.trim();
                const description = document.getElementById('food_description').value.trim();
                const imageFile = document.getElementById('food_image').files[0];
                const id = Date.now();

                if (!heading || !description || !imageFile) {
                    alert('Please fill all the fields!');
                    return;
                }

                const reader = new FileReader();

                reader.onloadend = function() {
                    const base64Image = reader.result;

                    const item = {
                        id,
                        heading,
                        description,
                        image_base64: base64Image
                    };

                    foodArray.push(item);
                    updateFoodInput();
                    renderFoodCard(item);

                    // Clear form
                    document.getElementById('food_heading').value = '';
                    document.getElementById('food_description').value = '';
                    document.getElementById('food_image').value = '';
                };

                reader.readAsDataURL(imageFile);
            });
        });
    </script>

    <!-- culture -->
    <script>
        // Array to store all culture entries
        let cultureArray = @json($culture ?? []);

        // Add new culture item
        document.getElementById('add-culture').addEventListener('click', function() {
            const input = document.getElementById('culture-input');
            const cultureValue = input.value.trim();
            const cultureId = Date.now(); // Unique ID

            if (!cultureValue) {
                alert('Please enter a culture value!');
                return;
            }

            const cultureItem = {
                id: cultureId,
                value: cultureValue
            };

            cultureArray.push(cultureItem);
            document.getElementById('culture-json').value = JSON.stringify(cultureArray);

            const card = document.createElement('div');
            card.setAttribute('id', `culture-${cultureId}`);
            card.classList.add(
                'bg-purple-100',
                'p-4',
                'rounded-lg',
                'shadow-sm',
                'flex',
                'justify-between',
                'items-center',
                'hover:border-2',
                'hover:border-purple-600'
            );

            card.innerHTML = `
            <div>
                <p class="text-gray-800">${cultureValue}</p>
            </div>
            <div>
                <button type="button" class="remove-culture-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-id="${cultureId}">Remove</button>
            </div>
        `;

            document.getElementById('culture-details').appendChild(card);

            card.querySelector('.remove-culture-btn').addEventListener('click', function() {
                if (confirm('Are you sure you want to remove this item?')) {
                    card.remove();
                    cultureArray = cultureArray.filter(c => c.id !== cultureId);
                    document.getElementById('culture-json').value = JSON.stringify(cultureArray);
                }
            });

            input.value = '';
        });

        // Load existing culture items on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (cultureArray.length > 0) {
                cultureArray.forEach((item) => {
                    const card = document.createElement('div');
                    card.setAttribute('id', `culture-${item.id}`);
                    card.classList.add(
                        'bg-purple-100',
                        'p-4',
                        'rounded-lg',
                        'shadow-sm',
                        'flex',
                        'justify-between',
                        'items-center',
                        'hover:border-2',
                        'hover:border-purple-600'
                    );

                    card.innerHTML = `
                    <div>
                        <p class="text-gray-800">${item.value}</p>
                    </div>
                    <div>
                        <button type="button" class="remove-culture-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-id="${item.id}">Remove</button>
                    </div>
                `;

                    document.getElementById('culture-details').appendChild(card);

                    card.querySelector('.remove-culture-btn').addEventListener('click', function() {
                        if (confirm('Are you sure you want to remove this item?')) {
                            card.remove();
                            cultureArray = cultureArray.filter(c => c.id !== item.id);
                            document.getElementById('culture-json').value = JSON.stringify(cultureArray);
                        }
                    });
                });

                document.getElementById('culture-json').value = JSON.stringify(cultureArray);
            }
        });
    </script>
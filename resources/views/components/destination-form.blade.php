@props([
'destination_categories',
'destination',
'languages',
'highlights',
'visit_times',
'worth_visit',
'food',
'culture'

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

                @php
                $languageCodes = collect($languages)->pluck('language_code')->toArray();
                @endphp


                @php
                $destinationName = json_decode($destination->destination_name ?? '{}', true);
                @endphp


                @php
                $destinationCardSummary = json_decode($destination->destination_card_summary ?? '{}', true);
                @endphp


                <div class="space-y-4 sm:flex sm:space-x-4 sm:space-y-0">

                    <!-- Destination Name Fields (Multilingual) -->
                    @foreach ($languages as $language)
                    <div class="mb-4 w-full">
                        <label for="destination_name_{{ $language->language_code }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Destination Name ({{ $language->language }})
                        </label>
                        <input type="text"
                            data-lang="{{ $language->language_code }}"
                            class="destination-name-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            id="destination_name_{{ $language->language_code }}"
                            placeholder="Enter destination name in {{ $language->language }}"
                            value="{{ old('destination_name_' . $language->language_code, $destinationName[$language->language_code] ?? '') }}">
                    </div>
                    @endforeach

                    <!-- Hidden JSON Field for Destination Name -->
                    <input type="hidden" name="destination_name" id="destination_name_json" value="{}">

                </div>

                <!-- Slug Field -->
                <div class="mb-4">
                    <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Slug <small class="text-xs text-gray-500">(auto-generated from English name)</small>
                    </label>
                    <input type="text"
                        name="slug"
                        id="slug"
                        readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Slug will be auto-generated from English name"
                        value="{{ old('slug', $destination->slug ?? '') }}">

                    <div id="slug-status" class="text-sm mt-1"></div>
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




                <!-- destination card summary -->
                <div class="grid grid-cols-2 gap-4 mt-2">
                    @foreach ($languages as $language)
                    <div class="mb-4">
                        <label for="destination_card_summary_{{ $language->language_code }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Destination Card Summary ({{ $language->language }})
                        </label>
                        <textarea
                            id="destination_card_summary_{{ $language->language_code }}"
                            data-summary-lang="{{ $language->language_code }}"
                            rows="6"
                            placeholder="Enter summary in {{ $language->language }}"
                            class="destination-card-summary-input block w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">{{ old('destination_card_summary_' . $language->language_code, $destinationCardSummary[$language->language_code] ?? '') }}</textarea>
                    </div>
                    @endforeach

                    <!-- Hidden JSON Field -->
                    <input type="hidden" name="destination_card_summary" id="destination_card_summary_json" value="{}">
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

                        <!-- Input for Adding Highlights (Multilingual) -->
                        <div class="grid grid-cols-1 gap-4" id="highlight-description-container">
                            @foreach ($languages as $language)
                            <div>
                                <label for="highlight-description-{{ $language->language_code }}"
                                    class="text-gray-600 text-sm font-medium">Highlight ({{ $language->language }})</label>
                                <input type="text"
                                    id="highlight-description-{{ $language->language_code }}"
                                    data-lang="{{ $language->language_code }}"
                                    class="highlight-description mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter highlight in {{ $language->language }}">
                            </div>
                            @endforeach
                        </div>

                        <!-- Add Highlight Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md" id="add-highlight">
                                Add Highlight
                            </button>
                        </div>

                        <!-- Highlight Card Details Section -->
                        <div class="mt-6 space-y-4" id="highlight-details">
                            <!-- Dynamic multilingual highlight cards will appear here -->
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

                        <!-- Input for Adding Best Time To Visit (Multilingual) -->
                        <div class="grid grid-cols-1 gap-4" id="visit-time-inputs">
                            @foreach ($languages as $language)
                            <div>
                                <label for="visit-description-{{ $language->language_code }}"
                                    class="text-gray-600 text-sm font-medium">Best Time To Visit ({{ $language->language }})</label>
                                <input type="text"
                                    id="visit-description-{{ $language->language_code }}"
                                    data-lang="{{ $language->language_code }}"
                                    class="visit-description mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter description in {{ $language->language }}">
                            </div>
                            @endforeach
                        </div>

                        <!-- Add Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-indigo-500 text-white px-4 py-2 rounded-md" id="add-visit-time">
                                Add Best Time To Visit
                            </button>
                        </div>

                        <!-- Display Section -->
                        <div class="mt-6 space-y-4" id="visit-time-details">
                            <!-- Dynamically added entries appear here -->
                        </div>

                        <!-- Hidden input to store JSON -->
                        <input type="hidden" id="visit-time-json" name="visit_times">
                    </div>
                </div>






                <!-- worth a visit -->
                <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                    <!-- Worth a Visit Cards Display -->
                    <div class="bg-white p-4 mt-4">
                        <div class="space-y-4" id="worth-visit-details">
                            <!-- Existing Worth a Visit Items Will Be Rendered Here -->
                        </div>
                    </div>

                    <!-- Add Worth a Visit Form -->
                    <div class="bg-white p-4 mt-4">
                        <h2 class="font-bold text-gray-700 text-xl mb-4">Add Worth a Visit</h2>

                        <div class="grid grid-cols-1 gap-4" id="worth-visit-inputs">
                            <!-- Multilingual Heading Inputs -->
                            @foreach ($languages as $language)
                            <div>
                                <label for="worth_visit_heading_{{ $language->language_code }}" class="text-gray-600 text-sm font-medium">Heading ({{ $language->language }})</label>
                                <input type="text"
                                    id="worth_visit_heading_{{ $language->language_code }}"
                                    data-lang="{{ $language->language_code }}"
                                    class="worth-visit-heading mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter heading in {{ $language->language }}">
                            </div>
                            @endforeach

                            <!-- Multilingual Description Inputs -->
                            @foreach ($languages as $language)
                            <div>
                                <label for="worth_visit_description_{{ $language->language_code }}" class="text-gray-600 text-sm font-medium">Description ({{ $language->language }})</label>
                                <textarea id="worth_visit_description_{{ $language->language_code }}"
                                    data-lang="{{ $language->language_code }}"
                                    rows="3"
                                    class="worth-visit-description mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Write description in {{ $language->language }}"></textarea>
                            </div>
                            @endforeach

                            <!-- Image Upload -->
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

                        <!-- Hidden input -->
                        <input type="hidden" id="worth_visit_json" name="worth_visit">
                    </div>
                </div>


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

                        <div class="grid grid-cols-1 gap-4" id="food-inputs">
                            <!-- Multilingual Headings -->
                            @foreach ($languages as $language)
                            <div>
                                <label for="food_heading_{{ $language->language_code }}" class="text-gray-600 text-sm font-medium">
                                    Food Name / Title ({{ $language->language }})
                                </label>
                                <input type="text"
                                    id="food_heading_{{ $language->language_code }}"
                                    data-lang="{{ $language->language_code }}"
                                    class="food-heading mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter food title in {{ $language->language }}">
                            </div>
                            @endforeach

                            <!-- Multilingual Descriptions -->
                            @foreach ($languages as $language)
                            <div>
                                <label for="food_description_{{ $language->language_code }}" class="text-gray-600 text-sm font-medium">
                                    Description ({{ $language->language }})
                                </label>
                                <textarea id="food_description_{{ $language->language_code }}"
                                    data-lang="{{ $language->language_code }}"
                                    class="food-description mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    rows="3"
                                    placeholder="Write about the food in {{ $language->language }}"></textarea>
                            </div>
                            @endforeach

                            <!-- Image -->
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

                        <!-- Input for Adding Culture (Multilingual) -->
                        <div class="grid grid-cols-1 gap-4" id="culture-description-container">
                            @foreach ($languages as $language)
                            <div>
                                <label for="culture-description-{{ $language->language_code }}"
                                    class="text-gray-600 text-sm font-medium">Culture ({{ $language->language }})</label>
                                <input type="text"
                                    id="culture-description-{{ $language->language_code }}"
                                    data-lang="{{ $language->language_code }}"
                                    class="culture-description mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                    placeholder="Enter culture in {{ $language->language }}">
                            </div>
                            @endforeach
                        </div>

                        <!-- Add Culture Button -->
                        <div class="flex justify-start mt-4">
                            <button type="button" class="bg-purple-600 text-white px-4 py-2 rounded-md" id="add-culture">
                                Add Culture
                            </button>
                        </div>

                        <!-- Culture Card Details Section -->
                        <div class="mt-6 space-y-4" id="culture-details">
                            <!-- Dynamic multilingual culture cards will appear here -->
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
        let highlightsArray = @json($highlights ?? []);

        document.getElementById('add-highlight').addEventListener('click', function() {
            const inputs = document.querySelectorAll('.highlight-description');
            const descriptions = {};
            let hasAtLeastOne = false;

            inputs.forEach(input => {
                const lang = input.dataset.lang;
                const val = input.value.trim();
                if (val !== '') {
                    descriptions[lang] = val;
                    hasAtLeastOne = true;
                }
            });

            if (!hasAtLeastOne) {
                alert('Please enter at least one language value!');
                return;
            }

            const highlightId = Date.now();
            const highlight = {
                id: highlightId,
                description: descriptions,
                created_at: new Date().toISOString().slice(0, 19).replace('T', ' ')
            };

            highlightsArray.push(highlight);
            document.getElementById('highlights-json').value = JSON.stringify(highlightsArray);

            appendHighlight(highlight);

            // Clear inputs
            inputs.forEach(input => input.value = '');
        });

        // Load existing on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (Array.isArray(highlightsArray) && highlightsArray.length > 0) {
                highlightsArray.forEach((item) => {
                    appendHighlight(item);
                });
                document.getElementById('highlights-json').value = JSON.stringify(highlightsArray);
            }
        });

        function appendHighlight(item) {
            const card = document.createElement('div');
            card.setAttribute('id', `highlight-${item.id}`);
            card.classList.add(
                'bg-green-100', 'p-4', 'rounded-lg', 'shadow-sm',
                'flex', 'justify-between', 'items-center',
                'hover:border-2', 'hover:border-green-500'
            );

            const descriptionsHtml = Object.entries(item.description)
                .map(([lang, text]) => `<p class="text-sm text-gray-800"><strong>${lang}:</strong> ${text}</p>`)
                .join('');

            card.innerHTML = `
            <div>${descriptionsHtml}</div>
            <div>
                <button type="button" class="remove-highlight-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-highlight-id="${item.id}">Remove</button>
            </div>
        `;

            document.getElementById('highlight-details').appendChild(card);

            card.querySelector('.remove-highlight-btn').addEventListener('click', function() {
                if (confirm('Are you sure you want to remove this highlight?')) {
                    card.remove();
                    highlightsArray = highlightsArray.filter((h) => h.id !== item.id);
                    document.getElementById('highlights-json').value = JSON.stringify(highlightsArray);
                }
            });
        }
    </script>


    <!-- best time to visit -->
    <script>
        let visitTimeArray = @json($visit_times ?? []);

        document.getElementById('add-visit-time').addEventListener('click', function() {
            const inputs = document.querySelectorAll('.visit-description');
            const descriptions = {};
            let hasAtLeastOne = false;

            inputs.forEach(input => {
                const lang = input.dataset.lang;
                const val = input.value.trim();
                if (val !== '') {
                    descriptions[lang] = val;
                    hasAtLeastOne = true;
                }
            });

            if (!hasAtLeastOne) {
                alert('Please enter at least one language value!');
                return;
            }

            const visitTimeId = Date.now();
            const visitTime = {
                id: visitTimeId,
                description: descriptions,
                created_at: new Date().toISOString().slice(0, 19).replace('T', ' ')
            };

            visitTimeArray.push(visitTime);
            document.getElementById('visit-time-json').value = JSON.stringify(visitTimeArray);

            appendVisitTime(visitTime);

            // Clear inputs
            inputs.forEach(input => input.value = '');
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (Array.isArray(visitTimeArray) && visitTimeArray.length > 0) {
                visitTimeArray.forEach((item) => {
                    appendVisitTime(item);
                });
                document.getElementById('visit-time-json').value = JSON.stringify(visitTimeArray);
            }
        });

        function appendVisitTime(item) {
            const card = document.createElement('div');
            card.setAttribute('id', `visit-time-${item.id}`);
            card.classList.add(
                'bg-indigo-100', 'p-4', 'rounded-lg', 'shadow-sm',
                'flex', 'justify-between', 'items-center',
                'hover:border-2', 'hover:border-indigo-500'
            );

            const descriptionsHtml = Object.entries(item.description)
                .map(([lang, text]) => `<p class="text-sm text-gray-800"><strong>${lang}:</strong> ${text}</p>`)
                .join('');

            card.innerHTML = `
            <div>${descriptionsHtml}</div>
            <div>
                <button type="button" class="remove-visit-time-btn bg-red-500 text-white px-2 py-1 rounded hover:bg-red-400" data-id="${item.id}">Remove</button>
            </div>
        `;

            document.getElementById('visit-time-details').appendChild(card);

            card.querySelector('.remove-visit-time-btn').addEventListener('click', function() {
                if (confirm('Are you sure you want to remove this entry?')) {
                    card.remove();
                    visitTimeArray = visitTimeArray.filter((t) => t.id !== item.id);
                    document.getElementById('visit-time-json').value = JSON.stringify(visitTimeArray);
                }
            });
        }
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

                const headings = Object.entries(item.heading)
                    .map(([lang, val]) => `<p class="text-sm"><strong>${lang} Heading:</strong> ${val}</p>`)
                    .join('');

                const descriptions = Object.entries(item.description)
                    .map(([lang, val]) => `<p class="text-sm"><strong>${lang} Description:</strong> ${val}</p>`)
                    .join('');

                const imageHtml = item.full_path || item.image_base64 ?
                    `<img src="${item.full_path || item.image_base64}" alt="Image" class="w-20 h-20 object-cover rounded-md">` :
                    '';

                card.innerHTML = `
                <div class="space-y-1">
                    ${headings}
                    ${descriptions}
                    <div><strong>Image:</strong> ${imageHtml}</div>
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

            // Add new Worth a Visit item
            document.getElementById('add-worth-visit').addEventListener('click', function() {
                const headingInputs = document.querySelectorAll('.worth-visit-heading');
                const descriptionInputs = document.querySelectorAll('.worth-visit-description');
                const imageFile = document.getElementById('worth_visit_image').files[0];

                const heading = {};
                const description = {};
                let hasHeading = false;
                let hasDescription = false;

                headingInputs.forEach(input => {
                    const val = input.value.trim();
                    if (val !== '') {
                        heading[input.dataset.lang] = val;
                        hasHeading = true;
                    }
                });

                descriptionInputs.forEach(input => {
                    const val = input.value.trim();
                    if (val !== '') {
                        description[input.dataset.lang] = val;
                        hasDescription = true;
                    }
                });

                if (!hasHeading || !hasDescription || !imageFile) {
                    alert('Please fill all required fields including image!');
                    return;
                }

                const id = Date.now();
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

                    // Clear form
                    headingInputs.forEach(input => input.value = '');
                    descriptionInputs.forEach(input => input.value = '');
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

                const headings = Object.entries(item.heading)
                    .map(([lang, val]) => `<p class="text-sm"><strong>${lang} Name:</strong> ${val}</p>`)
                    .join('');

                const descriptions = Object.entries(item.description)
                    .map(([lang, val]) => `<p class="text-sm"><strong>${lang} Description:</strong> ${val}</p>`)
                    .join('');

                const imageHtml = item.full_path || item.image_base64 ?
                    `<img src="${item.full_path || item.image_base64}" alt="Image" class="w-20 h-20 object-cover rounded-md">` :
                    '';

                card.innerHTML = `
                <div class="space-y-1">
                    ${headings}
                    ${descriptions}
                    <div><strong>Image:</strong> ${imageHtml}</div>
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

            // Load existing food on page load
            if (foodArray.length > 0) {
                foodArray.forEach(renderFoodCard);
                updateFoodInput();
            }

            // Add new food item
            document.getElementById('add-food').addEventListener('click', function() {
                const headingInputs = document.querySelectorAll('.food-heading');
                const descriptionInputs = document.querySelectorAll('.food-description');
                const imageFile = document.getElementById('food_image').files[0];

                const heading = {};
                const description = {};
                let hasHeading = false;
                let hasDescription = false;

                headingInputs.forEach(input => {
                    const val = input.value.trim();
                    if (val !== '') {
                        heading[input.dataset.lang] = val;
                        hasHeading = true;
                    }
                });

                descriptionInputs.forEach(input => {
                    const val = input.value.trim();
                    if (val !== '') {
                        description[input.dataset.lang] = val;
                        hasDescription = true;
                    }
                });

                if (!hasHeading || !hasDescription || !imageFile) {
                    alert('Please fill all required fields including image!');
                    return;
                }

                const id = Date.now();
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

                    // Clear inputs
                    headingInputs.forEach(input => input.value = '');
                    descriptionInputs.forEach(input => input.value = '');
                    document.getElementById('food_image').value = '';
                };

                reader.readAsDataURL(imageFile);
            });
        });
    </script>

    <!-- culture -->
    <script>
        let cultureArray = @json($culture ?? []);

        document.getElementById('add-culture').addEventListener('click', function() {
            const inputs = document.querySelectorAll('.culture-description');
            const descriptions = {};
            let hasAtLeastOne = false;

            inputs.forEach(input => {
                const lang = input.dataset.lang;
                const val = input.value.trim();
                if (val !== '') {
                    descriptions[lang] = val;
                    hasAtLeastOne = true;
                }
            });

            if (!hasAtLeastOne) {
                alert('Please enter at least one language value!');
                return;
            }

            const cultureId = Date.now();
            const cultureItem = {
                id: cultureId,
                description: descriptions,
                created_at: new Date().toISOString().slice(0, 19).replace('T', ' ')
            };

            cultureArray.push(cultureItem);
            document.getElementById('culture-json').value = JSON.stringify(cultureArray);

            appendCulture(cultureItem);

            // Clear inputs
            inputs.forEach(input => input.value = '');
        });

        // Load existing culture entries on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (Array.isArray(cultureArray) && cultureArray.length > 0) {
                cultureArray.forEach((item) => {
                    appendCulture(item);
                });
                document.getElementById('culture-json').value = JSON.stringify(cultureArray);
            }
        });

        function appendCulture(item) {
            const card = document.createElement('div');
            card.setAttribute('id', `culture-${item.id}`);
            card.classList.add(
                'bg-purple-100', 'p-4', 'rounded-lg', 'shadow-sm',
                'flex', 'justify-between', 'items-center',
                'hover:border-2', 'hover:border-purple-600'
            );

            const descriptionsHtml = Object.entries(item.description)
                .map(([lang, text]) => `<p class="text-sm text-gray-800"><strong>${lang}:</strong> ${text}</p>`)
                .join('');

            card.innerHTML = `
            <div>${descriptionsHtml}</div>
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
        }
    </script>



    @push('scripts')
    <!-- slug script  -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const langInputs = document.querySelectorAll('.destination-name-input');
            const jsonField = document.getElementById('destination_name_json');
            const slugField = document.getElementById('slug');
            const slugStatus = document.getElementById('slug-status');
            let nameData = {};

            function slugify(text) {
                return text.toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-');
            }

            function updateJSON() {
                nameData = {};
                langInputs.forEach(input => {
                    const lang = input.getAttribute('data-lang');
                    const val = input.value.trim();
                    if (val !== '') {
                        nameData[lang] = val;
                    }
                });
                jsonField.value = JSON.stringify(nameData);
            }

            function checkSlugAvailability(slug) {
                if (!slug) {
                    slugStatus.textContent = '';
                    return;
                }

                slugStatus.textContent = 'Checking...';
                slugStatus.className = 'text-sm mt-1 text-gray-500';

                fetch(`{{ url('/destinations/check-slug') }}?slug=${encodeURIComponent(slug)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.available) {
                            slugStatus.textContent = '✅ Slug is available';
                            slugStatus.className = 'text-sm mt-1 text-green-600';
                        } else {
                            slugStatus.textContent = '❌ Slug is already taken';
                            slugStatus.className = 'text-sm mt-1 text-red-600';
                        }
                    })
                    .catch(() => {
                        slugStatus.textContent = 'Error checking slug';
                        slugStatus.className = 'text-sm mt-1 text-red-600';
                    });
            }

            langInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const lang = this.getAttribute('data-lang');
                    updateJSON();

                    if (lang === 'en') {
                        const slug = slugify(this.value);
                        slugField.value = slug;
                        checkSlugAvailability(slug);
                    }
                });
            });

            // Initialize slug from existing English field
            const enInput = document.querySelector('[data-lang="en"]');
            if (enInput && enInput.value.trim() !== '') {
                const initialSlug = slugify(enInput.value);
                slugField.value = initialSlug;
                checkSlugAvailability(initialSlug);
            }

            // Initialize JSON on load
            updateJSON();
        });
    </script>

    <!-- destination card summary    -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const summaryInputs = document.querySelectorAll('.destination-card-summary-input');
            const summaryJsonField = document.getElementById('destination_card_summary_json');
            let summaryData = {};

            function updateSummaryJSON() {
                summaryData = {};
                summaryInputs.forEach(input => {
                    const lang = input.getAttribute('data-summary-lang');
                    const val = input.value.trim();
                    if (val !== '') {
                        summaryData[lang] = val;
                    }
                });
                summaryJsonField.value = JSON.stringify(summaryData);
            }

            summaryInputs.forEach(input => {
                input.addEventListener('input', updateSummaryJSON);
            });

            updateSummaryJSON();
        });
    </script>

    @endpush
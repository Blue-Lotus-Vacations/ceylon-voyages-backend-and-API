<div id="create-holiday-accordion-collapse" data-accordion="collapse">
    <h2 id="create-holiday-accordion-collapse-heading-1">
        <button type="button"
            class="flex justify-between items-center py-4 px-4 w-full font-medium leading-none text-left text-gray-900 bg-gray-50 sm:px-5 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600"
            data-accordion-target="#create-holiday-accordion-collapse-body-1" aria-expanded="true"
            aria-controls="create-holiday-accordion-collapse-body-1">
            <span>Languages Information</span>
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

                    <!-- Destination Category Name -->
                    <div class="w-full">
                        <label for="language"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Language Name</label>
                        <input type="text"
                            value="{{ old('language', $language->language ?? '') }}"
                            name="language"
                            id="language"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type Language">
                        <x-input-error :messages="$errors->get('language')" class="mt-2" />
                    </div>

                    <!-- Language code -->
                    <div class="w-full">
                        <label for="language_code"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Language Code</label>
                        <input type="text"
                            value="{{ old('language', $language->language_code ?? '') }}"
                            name="language_code"
                            id="language_code"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type Language Code">
                        <x-input-error :messages="$errors->get('language_code')" class="mt-2" />
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
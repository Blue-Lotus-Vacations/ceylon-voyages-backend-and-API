 @props([
 'destination_category',
 ])

 <div id="create-holiday-accordion-collapse" data-accordion="collapse">
     <h2 id="create-holiday-accordion-collapse-heading-1">
         <button type="button"
             class="flex justify-between items-center py-4 px-4 w-full font-medium leading-none text-left text-gray-900 bg-gray-50 sm:px-5 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600"
             data-accordion-target="#create-holiday-accordion-collapse-body-1" aria-expanded="true"
             aria-controls="create-holiday-accordion-collapse-body-1">
             <span>Destination Category Information</span>
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
                         <label for="destination_category_name"
                             class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination Category Name</label>
                         <input type="text"
                             value="{{ old('destination_category_name', $destination_category->destination_category_name ?? '') }}"
                             name="destination_category_name"
                             id="destination_category_name"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                             placeholder="Type Destination Category Name">
                         <x-input-error :messages="$errors->get('destination_category_name')" class="mt-2" />
                     </div>

                     <!-- Slug -->
                     <div class="w-full">
                         <label for="slug"
                             class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                         <input type="text"
                             value="{{ old('slug', $destination_category->slug ?? '') }}"
                             name="slug"
                             id="slug"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                             placeholder="Slug will be auto-generated (but you can edit)">
                         <div id="slug-status" class="text-sm mt-1"></div>
                         <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                     </div>
                 </div>

                 <div class="w-full">





                     @if (isset($destination_category))
                     @php

                     $featured_images = [];
                     foreach ($destination_category->assets as $asset) {
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
         </script>

         @push('scripts')
         <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
         <script>
             function slugify(text) {
                 return text.toLowerCase()
                     .trim()
                     .replace(/\s+/g, '-') // Replace spaces with -
                     .replace(/[^\w\-]+/g, '') // Remove special characters
                     .replace(/\-\-+/g, '-'); // Replace multiple - with single -
             }

             $(document).ready(function() {
                 let typingTimer;
                 const doneTypingInterval = 500;

                 $('#destination_category_name').on('input', function() {
                     const slug = slugify($(this).val());
                     $('#slug').val(slug);
                     checkSlugAvailability(slug);
                 });

                 $('#slug').on('input', function() {
                     clearTimeout(typingTimer);
                     const slug = $(this).val();
                     typingTimer = setTimeout(() => {
                         checkSlugAvailability(slug);
                     }, doneTypingInterval);
                 });

                 function checkSlugAvailability(slug) {
                     if (!slug) {
                         $('#slug-status').text('').removeClass('text-green-600 text-red-600');
                         return;
                     }

                     $.ajax({
                         url: '{{ url("/destination-category/check-slug") }}',
                         method: 'GET',
                         data: {
                             slug: slug
                         },
                         success: function(res) {
                             if (res.available) {
                                 $('#slug-status')
                                     .text('✅ Slug is available')
                                     .removeClass('text-red-600')
                                     .addClass('text-green-600');
                             } else {
                                 $('#slug-status')
                                     .text('❌ Slug is already taken')
                                     .removeClass('text-green-600')
                                     .addClass('text-red-600');
                             }
                         },
                         error: function() {
                             $('#slug-status')
                                 .text('Error checking slug.')
                                 .removeClass('text-green-600')
                                 .addClass('text-red-600');
                         }
                     });
                 }
             });
         </script>
         @endpush
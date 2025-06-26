<x-app-layout>
    <div class="p-2 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg ">

                <form id="itinerary-form" action="{{ route('holiday.itenery-store', $holiday) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="mb-5">
                            <label for="day_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Day Title</label>
                            <input type="text" name="day_title" id="day_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="mb-5">
                            <label for="day_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="day_description" id="day_description"></textarea>
                        </div>

                        <div class="mb-5">
                            <label for="day_images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Day Images</label>
                            <input id="day-image" type="file" name="day_images[]" multiple
                                class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                                onchange="previewImages(event)">

                            <!-- Preview Container -->
                            <div id="image-preview-container" class="mt-4 grid grid-cols-3 gap-4"></div>
                        </div>

                        <div class="mb-5">
                            <button type="button" onclick="submitForm()" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Add Itinerary</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- JavaScript for Image Preview and Proper Form Submission -->
    <script>
        let selectedFiles = [];

        function previewImages(event) {
            let container = document.getElementById('image-preview-container');
            let files = event.target.files;

            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];

                    if (file.type.startsWith('image/')) { // Ensure it's an image
                        selectedFiles.push(file); // Store file in the array

                        let reader = new FileReader();
                        reader.onload = function(e) {
                            let wrapper = document.createElement('div');
                            wrapper.className = 'relative group';

                            let img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-full h-32 object-cover rounded shadow-md';

                            // Remove button
                            let removeBtn = document.createElement('button');
                            removeBtn.innerHTML = '✖';
                            removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full px-2 py-1 opacity-0 group-hover:opacity-100 transition';
                            removeBtn.onclick = function() {
                                let index = selectedFiles.indexOf(file);
                                if (index > -1) {
                                    selectedFiles.splice(index, 1); // Remove file from array
                                }
                                wrapper.remove();
                            };

                            wrapper.appendChild(img);
                            wrapper.appendChild(removeBtn);
                            container.appendChild(wrapper);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        }

        function submitForm() {
            let form = document.getElementById('itinerary-form');
            let formData = new FormData(form);
            formData.delete('day_images[]'); // Remove existing files

            // Append all selected files to the formData
            for (let i = 0; i < selectedFiles.length; i++) {
                formData.append('day_images[]', selectedFiles[i]);
            }

            // Submit using Fetch API
            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json()) // Convert response to JSON
                .then(data => {
                    if (data.success) {
                        alert(data.message); // Show success message
                        window.location.href = data.redirect; // Redirect to index route
                    } else {
                        alert('Error submitting form'); // Handle failure
                    }
                })
                .catch(error => console.log('Error:', error));
        }
    </script>
</x-app-layout>
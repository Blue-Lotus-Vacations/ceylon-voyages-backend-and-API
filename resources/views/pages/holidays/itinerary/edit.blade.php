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

                <!-- Edit Itinerary Title -->
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Edit Itinerary</h2>

                <!-- Itinerary Edit Form -->
                <form id="edit-itinerary-form" action="{{ route('holiday.itenery-update', ['holiday' => $holiday->id, 'itinerary' => $itinerary['id']]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Day Title -->
                    <div class="mb-5">
                        <label for="day_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Day Title</label>
                        <input type="text" name="day_title" id="day_title" value="{{ old('day_title', $itinerary['day_title']) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <!-- Description -->
                    <div class="mb-5">
                        <label for="day_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea rows="10" name="day_description" id="day_description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('day_description', $itinerary['day_description']) }}</textarea>
                    </div>

                    <!-- Existing Images -->
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Existing Images</label>
                        <div class="bg-red-200 w-fit px-3 py-1 rounded-md mb-3 border-l-4 border-l-red-600 rounded-l-none">
                            <p class="text-sm text-red-900 dark:text-gray-400">Make Sure to Save Newly Uploaded Images Before Removing Exhisting Images.</p>
                        </div>
                        <div class="grid grid-cols-3 gap-4" id="existing-image-container">
                            @foreach ($itinerary['day_images'] as $image)

                            <div class="relative group">
                                <img src="{{ Storage::url($image['file_name']) }}" alt="Day Image"
                                    class="w-full h-32 object-cover rounded shadow-md">
                                <!-- Delete Button -->
                                <button type="button" onclick="removeImage('{{ $image['file_name'] }}', this, '{{ $itinerary['id'] }}', '{{ $holiday->id }}')"
                                    class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full px-2 py-1 opacity-0 group-hover:opacity-100 transition">
                                    ✖
                                </button>

                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Upload New Images -->
                    <div class="mb-5">
                        <label for="day_images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload New Images</label>
                        <input id="day-image" type="file" name="day_images[]" multiple
                            class="mt-0.5 p-3 border border-gray-300 w-full text-gray-700 rounded text-sm focus:outline focus:outline-blue-500"
                            onchange="previewImages(event)">

                        <!-- New Image Previews -->
                        <div id="image-preview-container" class="mt-4 grid grid-cols-3 gap-4"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-5">
                        <button type="button" onclick="submitEditForm()"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            Update Itinerary
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- JavaScript for Image Preview & Delete -->
    <script>
        let selectedFiles = [];

        function previewImages(event) {
            let container = document.getElementById('image-preview-container');
            let files = event.target.files;

            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];

                    if (file.type.startsWith('image/')) {
                        selectedFiles.push(file);

                        let reader = new FileReader();
                        reader.onload = function(e) {
                            let wrapper = document.createElement('div');
                            wrapper.className = 'relative group';

                            let img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-full h-32 object-cover rounded shadow-md';

                            let removeBtn = document.createElement('button');
                            removeBtn.innerHTML = '✖';
                            removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full px-2 py-1 opacity-0 group-hover:opacity-100 transition';
                            removeBtn.onclick = function() {
                                let index = selectedFiles.indexOf(file);
                                if (index > -1) {
                                    selectedFiles.splice(index, 1);
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

        function submitEditForm() {
            let form = document.getElementById('edit-itinerary-form');
            let formData = new FormData(form);
            formData.delete('day_images[]');

            for (let i = 0; i < selectedFiles.length; i++) {
                formData.append('day_images[]', selectedFiles[i]);
            }

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = data.redirect;
                    } else {
                        alert('Error updating itinerary');
                    }
                })
                .catch(error => console.log('Error:', error));
        }

        function removeImage(fileName, button, itineraryId, holiday) {
            if (confirm("Are you sure you want to delete this image?")) {
                let dayTitle = document.getElementById('day_title').value;
                let dayDescription = document.getElementById('day_description').value;
                let body = {
                    day_title: dayTitle,
                    day_description: dayDescription
                };
                let deleteUrl = "{{ route('holiday.itenery-image-delete') }}?file_name=" + fileName + "&itinerary_id=" + itineraryId + "&holiday_id=" + holiday + "&data =" + JSON.stringify(body);

                fetch(deleteUrl, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.log('Error:', error));
            }
        }
    </script>
</x-app-layout>
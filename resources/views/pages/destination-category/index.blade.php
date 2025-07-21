 <x-app-layout>
     <div class="p-2 sm:ml-64">
         <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
             <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg ">

                 <div class="border-b dark:border-gray-700 mx-4">
                     @if(session('error'))
                     <div id="alert-border-3" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                         <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                         </svg>
                         <div class="ms-3 text-sm font-medium">
                             {{ session('error') }}
                         </div>
                         <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-border-3" aria-label="Close">
                             <span class="sr-only">Dismiss</span>
                             <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                             </svg>
                         </button>
                     </div>
                     @endif

                     @if(session('success'))
                     <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                         <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                             <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                         </svg>
                         <div class="ms-3 text-sm font-medium">
                             {{ session('success') }}
                         </div>
                         <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-border-3" aria-label="Close">
                             <span class="sr-only">Dismiss</span>
                             <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                             </svg>
                         </button>
                     </div>
                     @endif
                     <div class="flex items-center justify-between space-x-4 pt-3">
                         <div class="flex-1 flex items-center space-x-3">
                             <h5 class="dark:text-white font-semibold">All Destination Categories</h5>
                         </div>
                     </div>

                     <div class="flex flex-col-reverse md:flex-row items-center justify-between md:space-x-4 py-3">
                         <div class="w-full lg:w-2/3 flex flex-col space-y-3 md:space-y-0 md:flex-row md:items-center">
                             <!-- search for Holidays  -->


                         </div>

                         <div class="w-full md:w-auto flex flex-col md:flex-row mb-3 md:mb-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                             <a href="{{ route('destination-category-create') }}" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                 <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                     <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                 </svg>
                                 Add new Destination Category
                             </a>
                         </div>
                     </div>
                 </div>



                 <!-- Table  -->
                 <div class="overflow-x-auto ">
                     <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                         <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                             <tr>

                                 <th scope="col" class="px-4 py-3 min-w-[14rem]">Holiday</th>


                                 <th scope="col" class="px-4 py-3">
                                     <span class="sr-only">Actions</span>
                                 </th>
                             </tr>
                         </thead>

                         <tbody class="border-b-[40px] border-[#1A437E] ">

                             @foreach ($destination_categories as $destination_category)


                             @php
                             foreach($destination_category->assets as $asset){
                             if($asset->IsFeatured_image){
                             $featured_image = $asset->file_path;
                             }
                             }
                             @endphp



                             <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 ">

                                 <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center">
                                     <img src="{{url($featured_image) }}" alt="iMac Front Image" class="object-cover w-10 h-10 rounded-full mr-3">
                                     {{ json_decode($destination_category->destination_category_name)->en ?? '' }}
                                 </th>

                                 <td class="px-4 py-3 ">
                                    <button id="{{$destination_category->destination_category_name}}-dropdown-button" type="button" data-dropdown-toggle="{{$destination_category->destination_category_name}}-dropdown" class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="{{$destination_category->destination_category_name}}-dropdown" class="hidden  z-50 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">

                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="{{$destination_category->destination_category_name}}-dropdown-button">
                                            <li>
                                                <a href="{{ route('destination_category.edit' ,$destination_category->id ) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>

                             </tr>

                             @endforeach

                         </tbody>

                     </table>

                     <!-- Pagination Links -->
                     <div class="grid mt-4">

                     </div>
                 </div>


             </div>
         </div>
     </div>

 </x-app-layout>
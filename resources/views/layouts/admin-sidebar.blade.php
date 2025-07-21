<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <!-- Dashboard  -->
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <!-- holidays -->
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">

                    <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.37 7.657c2.063.528 2.396 2.806 3.202 3.87 1.07 1.413 2.075 1.228 3.192 2.644 1.805 2.289 1.312 5.705 1.312 6.705M20 15h-1a4 4 0 0 0-4 4v1M8.587 3.992c0 .822.112 1.886 1.515 2.58 1.402.693 2.918.351 2.918 2.334 0 .276 0 2.008 1.972 2.008 2.026.031 2.026-1.678 2.026-2.008 0-.65.527-.9 1.177-.9H20M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>


                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Holidays</span>

                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example2" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('holidays') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">All Holidays</a>
                    </li>
                </ul>
            </li>


            <!-- destinations -->
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example3" data-collapse-toggle="dropdown-example3">

                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M21,2 C20.3597108,2 19.7456461,2.25435391 19.2928932,2.70710678 L16.4003571,5.59964294 C16.1519767,5.84802329 15.7914897,5.94787242 15.4507147,5.86267866 L4,3 L2.98105825,4.01894175 C2.59053396,4.40946604 2.59053396,5.04263102 2.98105825,5.43315531 C3.05705957,5.50915663 3.14481653,5.57240826 3.24095144,5.62047572 L12,10 L8,14 L3.61803399,14 C3.23926193,14 2.89299881,14.2140024 2.7236068,14.5527864 L2,16 L2,16 L6,18 L6,18 L8,22 L9.4472136,21.2763932 C9.78599762,21.1070012 10,20.7607381 10,20.381966 L10,16 L14,12 L18.3795243,20.7590486 C18.6265135,21.2530271 19.2271866,21.4532514 19.7211651,21.2062622 C19.8173,21.1581947 19.9050569,21.0949431 19.9810583,21.0189417 L21,20 L18.1373213,8.54928535 C18.0521276,8.20851033 18.1519767,7.84802329 18.4003571,7.59964294 L21.2928932,4.70710678 C21.7456461,4.25435391 22,3.64028925 22,3 C22,2.44771525 21.5522847,2 21,2 Z" />
                    </svg>


                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Destinations</span>

                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example3" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('destinations') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">All Destinations</a>
                    </li>
                    <li>
                        <a href="{{ route('destination-category') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">All Destination Categories</a>
                    </li>
                </ul>
            </li>

            <!-- lanugages -->
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example3" data-collapse-toggle="dropdown-example4">

                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10
           10-4.48 10-10S17.52 2 12 2zm5.93 6h-3.29a17.84
           17.84 0 0 0-1.35-3.36A8.04 8.04 0 0 1 17.93 8zM12
           4.07A15.91 15.91 0 0 1 13.95 8h-3.9A15.91 15.91 0
           0 1 12 4.07zM4.26 8a8.04 8.04 0 0 1 4.64-3.36A17.84
           17.84 0 0 0 7.55 8H4.26zM4 12c0-.69.1-1.36.26-2h3.66a20.4
           20.4 0 0 0 0 4H4." />
                    </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Languages</span>

                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example4" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('languages') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">All Languages</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</aside>
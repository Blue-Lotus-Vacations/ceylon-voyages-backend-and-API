<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $holidays = Holiday::with('assets')->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.holidays.index')->with('holidays', $holidays);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();

        return view('pages.holidays.create')->with('languages', $languages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);


        $validatedData = $request->validate([
            'deal_name' => 'required',
            'price' => 'required',
            'no_of_nights' => 'required',
            'description' => 'required',
            'itinerary_description' => 'required',
            'cost_includes_description' => 'required',
            'tour_map_description' => 'required',
            'aditional_information' => 'required',
            'slug' => 'required'
        ]);

        // dd($validatedData);

        // Is Favourite 
        if ($request->isFavorite == "on") {
            $validatedData['isFavorite'] = true;
        } else {
            $validatedData['isFavorite'] = false;
        }

        #region itinerary_cards json
        $savedItineraryCards = [];
        if ($request->has('itinerary_cards')) {
            $itinerary_cards = json_decode($request->itinerary_cards, true);

            foreach ($itinerary_cards as $itinerary_card) {

                $savedItineraryCards[] = [
                    "id" => $itinerary_card['id'],
                    "description" => $itinerary_card['description'],
                    "created_at" => now()->toDateTimeString()
                ];
            }
            $validatedData['itinerary_card'] = json_encode($savedItineraryCards, JSON_UNESCAPED_SLASHES);
        }

        // dd($validatedData);


        #region cost includes json
        $savedCostIncludes = [];
        if ($request->has('cost_includes')) {
            $costIncludes = json_decode($request->cost_includes, true);

            foreach ($costIncludes as $costInclude) {

                $savedCostIncludes[] = [
                    "id" => $costInclude['id'],
                    "description" => $costInclude['description'],
                    "created_at" => now()->toDateTimeString()
                ];
            }
            $validatedData['cost_includes'] = json_encode($savedCostIncludes, JSON_UNESCAPED_SLASHES);
        }

        // dd($validatedData);

        #region tour map Json
        $savedMulticities = [];
        if ($request->has('coordinates_json')) {
            // Decode the JSON input from the request
            $multicities = json_decode($request->coordinates_json, true);

            foreach ($multicities as $cityData) {
                $savedMulticities[] = [
                    "id" => $cityData['id'], // Unique ID for the city
                    "latitude" => $cityData['latitude'], // Latitude of the city
                    "longitude" => $cityData['longitude'], // Longitude of the city
                    "created_at" => now()->format('Y-m-d H:i:s.u'), // Timestamp
                ];
            }

            // Save the encoded multicities data to the validated data
            $validatedData['tour_map'] = json_encode($savedMulticities, JSON_UNESCAPED_SLASHES);
        }
        #endregion


        $holiday = Holiday::create($validatedData);


        #region Featured Image
        $imagePathfeatured_image = $request->file('featured_image')->store('public/holiday_images/' . uniqid());
        $featuredUrlFullPath = asset(Storage::url($imagePathfeatured_image));

        Asset::create([
            'referenceId' => $holiday->id,
            'file_path' => $featuredUrlFullPath,
            'attachment_type' => "Holiday Image",
            'IsFeatured_image' => true
        ]);

        #endregion

        for ($i = 1; $i <= count($request->file('holiday_images')); $i++) {

            if (isset($request->file('holiday_images')[$i - 1])) {
                $imagePath = $request->file('holiday_images')[$i - 1]->store('public/holiday_images');
                $imageUrlFullPath = asset(Storage::url($imagePath));

                Asset::create([
                    'referenceId' => $holiday->id,
                    'file_path' => $imageUrlFullPath,
                    'attachment_type' => "Holiday Image",
                    'IsFeatured_image' => false
                ]);
            }
        }

        return redirect()->route('holidays')->with('success', 'Holiday Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($holiday_id)
    {
        $holiday = Holiday::with('assets')->find($holiday_id);

        $itinerary_cards = json_decode($holiday->itinerary_card, true);

        $cost_includes = json_decode($holiday->cost_includes, true);

        $tour_map = json_decode($holiday->tour_map, true);

        $languages = Language::all();

        return view('pages.holidays.edit')->with(
            [
                'holiday' => $holiday,
                'itinerary_cards' => $itinerary_cards,
                'cost_includes' => $cost_includes,
                'multicities' => $tour_map,
                'languages' => $languages
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $holiday_id)
    {

        // dd($request);

        $holidays = Holiday::with('assets')->find($holiday_id);

        // dd($holidays);

        $inputimage_total = empty($request->file('holiday_images')) ? 0 : count($request->file('holiday_images'));

        if ($inputimage_total > 6) {
            return back()->with('error', 'New Holiday Images Cannot Exceed 6 images');
        }

        //featured images count
        $featured_image_count = $holidays->assets->filter(function ($asset) {
            return $asset->IsFeatured_image === 1;
        })->count();

        // get the count of the destination images without the featured image 
        $holidayimagecount = $holidays->assets->filter(function ($asset) {
            return $asset->IsFeatured_image === 0;
        })->count();

        $images_left_to_uplaod = 6 -  $holidayimagecount;

        // if the input count is larger than 6 validation 
        if (($holidayimagecount + $inputimage_total) > 6) {
            return back()->with('error', 'Total Images Cannot exceed 6 images. Only ' . $images_left_to_uplaod . ' can be Uploaded');
        }


        if ($images_left_to_uplaod >= 6 && $images_left_to_uplaod < 0) {
            return back()->with('error', 'Only ' . $images_left_to_uplaod . ' can be Uploaded');
        }


        if ($inputimage_total > $images_left_to_uplaod) {
            return back()->with('error', 'Only ' . $images_left_to_uplaod . ' can be Uploaded');
        }

        if ($featured_image_count > 1 && $request->hasFile('featured_image')) {
            return back()->with('error', 'Only ' . 1 . ' Featured image can be Uploaded');
        }
        if ($images_left_to_uplaod === 6 && $inputimage_total) {
            if ($featured_image_count === 0) {
                $request->validate([
                    'featured_image' => 'required',
                ]);
            } else {
                $request->validate([
                    'holiday_images' => 'required',
                ]);
            }
        }

        $validatedData = $request->validate([
            'deal_name' => 'required',
            'price' => 'required',
            'no_of_nights' => 'required',
            'description' => 'required',
            'itinerary_description' => 'required',
            'cost_includes_description' => 'required',
            'tour_map_description' => 'required',
            'aditional_information' => 'required',
            'slug' => 'required'
        ]);

        if ($request->isFavorite == "on") {
            $validatedData['isFavorite'] = true;
        } else {
            $validatedData['isFavorite'] = false;
        }


        #region itinarary card Json
        $savedItineraryCards = [];

        // Get existing seasons details from the featured holiday
        $existingItineraryCards = json_decode($holidays->itinerary_card ?? '[]', true);
        // $existingYoutubeLinks = $existingYoutubeLinks['youtube_shorts'] ?? [];

        if ($request->has('itinerary_cards')) {
            $itinerary_cards = json_decode($request->itinerary_cards, true);

            foreach ($itinerary_cards as $itinerary_card) {
                $isExisting = false;

                // Check if season already exists in the existing seasons array
                foreach ($existingItineraryCards as $existingItineraryCard) {
                    if ($existingItineraryCard['id'] == $itinerary_card['id']) {
                        $isExisting = true;
                        break;
                    }
                }



                // Build the JSON structure for the new season
                $savedItineraryCards[] = [
                    "id" => $itinerary_card['id'],
                    "description" => $itinerary_card['description'],
                    "created_at" => now()->toDateTimeString()
                ];
            }

            // Merge new seasons with existing ones
            if (!empty($savedItineraryCards)) {
                $existingItineraryCards = $savedItineraryCards;
            } else if (empty($itinerary_cards)) {
                $existingItineraryCards = [];
            }

            // Save or update the seasons data in the request
            $validatedData['itinerary_card'] = json_encode($existingItineraryCards, JSON_UNESCAPED_SLASHES);

            // dd($validatedData);
        }
        #endregion




        #region cost includes Json
        $savedCostIncludes = [];

        // Get existing seasons details from the featured holiday
        $existingCostIncludes = json_decode($holidays->cost_includes ?? '[]', true);
        // $existingYoutubeLinks = $existingYoutubeLinks['youtube_shorts'] ?? [];

        if ($request->has('itinerary_cards')) {
            $cost_includes = json_decode($request->cost_includes, true);

            foreach ($cost_includes as $cost_include) {
                $isExisting = false;

                // Check if season already exists in the existing seasons array
                foreach ($existingCostIncludes as $existingCostInclude) {
                    if ($existingCostInclude['id'] == $cost_include['id']) {
                        $isExisting = true;
                        break;
                    }
                }



                // Build the JSON structure for the new season
                $savedCostIncludes[] = [
                    "id" => $cost_include['id'],
                    "description" => $cost_include['description'],
                    "created_at" => now()->toDateTimeString()
                ];
            }

            // Merge new seasons with existing ones
            if (!empty($savedCostIncludes)) {
                $existingCostIncludes = $savedCostIncludes;
            } else if (empty($cost_includes)) {
                $existingCostIncludes = [];
            }

            // Save or update the seasons data in the request
            $validatedData['cost_includes'] = json_encode($existingCostIncludes, JSON_UNESCAPED_SLASHES);

            // dd($validatedData);
        }
        #endregion



        #region tour map Json
        $savedMulticities = [];

        // Get existing seasons details from the featured holiday
        $existingMultiCities = json_decode($holidays->tour_map ?? '[]', true);
        // $existingYoutubeLinks = $existingYoutubeLinks['youtube_shorts'] ?? [];

        if ($request->has('coordinates_json')) {
            $multicities = json_decode($request->coordinates_json, true);

            foreach ($multicities as  $multicity) {
                $isExisting = false;

                // Check if season already exists in the existing seasons array
                foreach ($existingMultiCities as  $existingMultiCity) {
                    if ($existingMultiCity['id'] == $multicity['id']) {
                        $isExisting = true;
                        break;
                    }
                }


                // Build the JSON structure for the new season
                $savedMulticities[] = [
                    "id" => $multicity['id'], // Unique ID for the city
                    "latitude" => $multicity['latitude'], // Latitude of the city
                    "longitude" => $multicity['longitude'], // Longitude of the city
                    "created_at" => now()->toDateTimeString(), // Timestamp
                ];
            }

            // Merge new seasons with existing ones
            if (!empty($savedMulticities)) {
                $existingMultiCities = $savedMulticities;
            } else if (empty($multicities)) {
                $existingMultiCities = [];
            }

            // Save or update the seasons data in the request
            $validatedData['tour_map'] = json_encode($existingMultiCities, JSON_UNESCAPED_SLASHES);

            // dd($validatedData);
        }
        #endregion

        $holidays->update($validatedData);


        if ($inputimage_total >= 1) {
            for ($i = 1; $i <= count($request->file('holiday_images')); $i++) {

                if (isset($request->file('holiday_images')[$i - 1])) {
                    $imagePath = $request->file('holiday_images')[$i - 1]->store('public/holiday_images');
                    $imageUrlFullPath = asset(Storage::url($imagePath));
                    Asset::updateOrCreate([
                        'referenceId' => $holidays->id,
                        'file_path' => $imageUrlFullPath,
                        'attachment_type' => "Holiday Image",
                        'IsFeatured_image' => false
                    ]);
                }
            }
        }

        if (!empty($request->file('featured_image'))) {

            $imagePathfeatured_image = $request->file('featured_image')->store('public/holiday_images');
            $featuredUrlFullPath = asset(Storage::url($imagePathfeatured_image));
            Asset::updateOrCreate([
                'referenceId' => $holidays->id,
                'file_path' => $featuredUrlFullPath,
                'attachment_type' => "Holiday Image",
                'IsFeatured_image' => true
            ]);
        }


        return redirect()->route('holiday.edit', $holidays)->with('success', "Holiday Updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        //
    }


    public function itinerary_index(Request $request, Holiday $holiday)
    {
        $itineraries = json_decode($holiday->itineraries, true);
        // dd($holiday);  
        return view('pages.holidays.itinerary.index')->with(['holiday' => $holiday, 'itineraries' => $itineraries]);
    }

    public function itinerary_create(Request $request, Holiday $holiday)
    {

        $languages = Language::all();

        return view('pages.holidays.itinerary.create')->with(['holiday' => $holiday, 'languages' => $languages]);
    }

    public function itinerary_store(Request $request, Holiday $holiday)
    {
        $validatedData = $request->validate([
            'day_title' => 'required',
            'day_description' => 'required',
        ]);

        $itineraries = json_decode($holiday->itineraries, true) ?? [];
        $newImages = [];
        if (!empty($request->file('day_images'))) {
            foreach ($request->file('day_images') as $image) {
                $imagePath = $image->store('public/holidays_itinerary_images');
                $imageUrlFullPath = asset(Storage::url($imagePath));
                $newImages[] = [
                    'file_name' => $imagePath,
                    'full_path' => $imageUrlFullPath,
                ];
            }
        }

        $itineraries[] = [
            "id" => uniqid(),
            "day_title" => $validatedData['day_title'],
            "day_description" => $validatedData['day_description'],
            "day_images" => $newImages,
            "created_at" => now()->toDateTimeString(),
        ];

        $holiday->update(['itineraries' => json_encode($itineraries, JSON_UNESCAPED_SLASHES)]);
        $itineraries = json_decode($holiday->itineraries, true) ?? [];


        // Return JSON response with redirect URL
        return response()->json([
            'success' => true,
            'message' => 'Itinerary Added Successfully!',
            'redirect' => route('holiday.itenery-index', $holiday),
        ]);
    }

    public function itinerary_show(Holiday $holiday, $itenery_id)
    {
        $itineraries = json_decode($holiday->itineraries, true);
        $itinerary = [];

        foreach ($itineraries as $iteneryData) {
            if ($iteneryData['id'] == $itenery_id) {
                $itinerary = $iteneryData;
                break;
            }
        }
        return view('pages.holidays.itinerary.show')->with(['holiday' => $holiday, 'itinerary' => $itinerary]);
    }

    public function itinerary_edit($itenery_id, Holiday $holiday)
    {
        $itineraries = json_decode($holiday->itineraries, true);
        $itinerary = [];

        foreach ($itineraries as $iteneryData) {
            if ($iteneryData['id'] == $itenery_id) {
                $itinerary = $iteneryData;
                break;
            }
        }

        $languages = Language::all();

        // dd($itinerary);
        return view('pages.holidays.itinerary.edit')->with(['holiday' => $holiday, 'itinerary' => $itinerary, 'languages' => $languages]);
    }

    public function itinerary_update(Request $request, Holiday $holiday, $itineraryid)
    {

        $validatedData = $request->validate([
            'day_title' => 'nullable',
            'day_description' => 'nullable',
        ]);

        $existingItineraries = json_decode($holiday->itineraries, true) ?? [];
        $itinerartKey = 0;
        $Exsitingitinerary = [];


        $itineraryData = [
            "id" => $itineraryid,
            "day_title" => $validatedData['day_title'],
            "day_description" => $validatedData['day_description'],
            "day_images" => $request->day_images,
        ];


        foreach ($existingItineraries as $key => $existingItineraryData) {

            if ((string)$existingItineraryData['id'] == $itineraryid) {
                $itinerartKey = $key;
                $Exsitingitinerary = $existingItineraryData;
                break;
            }
        }
        $ExsitingitineraryDayImages = $Exsitingitinerary['day_images'];


        // Initialize an array to store updated images
        $updatedImages = $ExsitingitineraryDayImages;

        // Check if there are new images to be added
        if (!empty($itineraryData['day_images'])) {
            foreach ($request->file('day_images') as $image) {
                $imagePath = $image->store('public/holidays_itinerary_images');
                $imageUrlFullPath = asset(Storage::url($imagePath));
                $updatedImages[] = [
                    'file_name' => $imageUrlFullPath,
                    'full_path' => Storage::url($imagePath),
                ];
            }
        } else {
            $updatedImages = $Exsitingitinerary['day_images'];
        }

        $Exsitingitinerary['day_title'] = $validatedData['day_title'];
        $Exsitingitinerary['day_description'] = $validatedData['day_description'];
        $Exsitingitinerary['day_images'] = $updatedImages;

        $existingItineraries[$itinerartKey] = $Exsitingitinerary;

        $holiday->update(['itineraries' => json_encode($existingItineraries, JSON_UNESCAPED_SLASHES)]);


        // Return JSON response with redirect URL
        return response()->json([
            'success' => true,
            'message' => 'Itinerary Updated Successfully!',
            'redirect' => route('holiday.itenery-index', $holiday),
        ]);
    }


    public function itinerary_destroy(Request $request, $itinerary_id, Holiday $holiday)
    {

        $itineraries = json_decode($holiday->itineraries, true);
        $itinerary = [];

        foreach ($itineraries as $key => $iteneryData) {
            if ((string)$iteneryData['id'] == $itinerary_id) {
                unset($itineraries[$key]);
                break;
            }
        }

        $holiday->update(['itineraries' => json_encode(array_values($itineraries), JSON_UNESCAPED_SLASHES)]);


        return  redirect()->route('holiday.itenery-index', $holiday);
    }

    public function deleteImage(Request $request)
    {

        try {
            // Construct the full path (ensure it matches stored path)
            $filePath =  $request->file_name;
            $holiday = Holiday::find($request->holiday_id);
            $itenery_id = $request->itinerary_id;

            $itineraries = json_decode($holiday->itineraries, true);
            $itinerary = [];
            $itinerartKey = 0;


            $data = Json_decode($request->data_, true);
            $day_title = $data['day_title'];
            $day_description = $data['day_description'];

            foreach ($itineraries as $key => $iteneryData) {

                if ((string)$iteneryData['id'] == $itenery_id) {
                    $itinerartKey = $key;
                    $itinerary = $iteneryData;
                    break;
                }
            }

            // Check if the file exists
            if (Storage::exists($filePath)) {
                // Delete the file from storage
                $deleted = Storage::delete($filePath);
            }


            //Remove the image from the array
            foreach ($itinerary['day_images'] as $key => $image) {
                if ($image['file_name'] == $filePath) {
                    unset($itinerary['day_images'][$key]);
                }
            }
            $itinerary['day_title'] = $day_title;
            $itinerary['day_description'] = $day_description;

            //Save Itenerary
            $itineraries[$itinerartKey] = $itinerary;

            //Update the holiday
            $holiday->update(['itineraries' => json_encode($itineraries, JSON_UNESCAPED_SLASHES)]);


            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }


    public function holidayApi()
    {
        $holidays = Holiday::with('assets')->get();
        return response()->json($holidays);
    }


    public function checkSlug(Request $request)
    {
        $slug = $request->query('slug');

        $exists = Holiday::where('slug', $slug)->exists();

        return response()->json(['available' => !$exists]);
    }


    
}

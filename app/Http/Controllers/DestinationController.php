<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Asset;
use App\Models\Language;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $languages = Language::all();

        $destinations = Destination::with('assets')->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.destinations.index')->with('destinations', $destinations)->with('languages', $languages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $destination_categories = DestinationCategory::all();

        $languages = Language::all();

        return view('pages.destinations.create', [
            'destination_categories' => $destination_categories,
            'languages' => $languages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([
            'destination_name' => 'required',
            'destination_category' => 'required',
            'destination_card_summary' => 'required',
            'slug' => 'required'
        ]);


         // Is Favourite 
        if ($request->isFavorite == "on") {
            $validatedData['isFavorite'] = true;
        } else {
            $validatedData['isFavorite'] = false;
        }


        #region highlights
        $savedhighlights = [];
        if ($request->has('highlights')) {
            $highlights = json_decode($request->highlights, true);

            foreach ($highlights as $highlight) {

                $savedhighlights[] = [
                    "id" => $highlight['id'],
                    "description" => $highlight['description'],
                    "created_at" => now()->toDateTimeString()
                ];
            }
            $validatedData['highlights'] = json_encode($savedhighlights, JSON_UNESCAPED_SLASHES);
        }


        #region visit time
        $savedVisitTimes = [];
        if ($request->has('visit_times')) {
            $visitTimes = json_decode($request->visit_times, true);

            foreach ($visitTimes as $visitTime) {

                $savedVisitTimes[] = [
                    "id" => $visitTime['id'],
                    "description" => $visitTime['description'],
                    "created_at" => now()->toDateTimeString()
                ];
            }
            $validatedData['visit_time'] = json_encode($savedVisitTimes, JSON_UNESCAPED_SLASHES);
        }


         #region culture
        $savedCultures = [];
        if ($request->has('culture')) {
            $cultures = json_decode($request->culture, true);

            foreach ($cultures as $culture) {

                $savedCultures[] = [
                    "id" => $culture['id'],
                    "description" => $culture['description'],
                    "created_at" => now()->toDateTimeString()
                ];
            }
            $validatedData['culture'] = json_encode($savedCultures, JSON_UNESCAPED_SLASHES);
        }


        #region worth a visit Json
        $savedWorthVisit = [];
        if ($request->has('worth_visit')) {
            $worthVisits = json_decode($request->worth_visit, true);

            foreach ($worthVisits as $worthVisit) {
                if (!empty($worthVisit['image_base64'])) {
                    $imageData = $worthVisit['image_base64'];
                    list($type, $imageData) = explode(';', $imageData);
                    list(, $imageData) = explode(',', $imageData);
                    $imageData = base64_decode($imageData);
                    $extension = explode('/', $type)[1];
                    $fileName = uniqid() . '.' . $extension;
                    $filePath = '/public/destination_worth_a_visit/' . $fileName;
                    Storage::disk('public')->put($filePath, $imageData);
                    $fullPath = Storage::url($filePath);
                }

                $savedWorthVisit[] = [
                    "id" => $worthVisit['id'],
                    "heading" => $worthVisit['heading'],
                    "description" => $worthVisit['description'],
                    "worth_visit_image" => $fileName,
                    "full_path" => $fullPath,
                    "created_at" => now()->toDateTimeString()
                ];
            }
            $validatedData['worth_a_visit'] = json_encode($savedWorthVisit, JSON_UNESCAPED_SLASHES);
        }
        #endregion



        #region food Json
        $savedFood = [];
        if ($request->has('food_json')) {
            $foods = json_decode($request->food_json, true);

            foreach ($foods as $food) {
                if (!empty($food['image_base64'])) {
                    $imageData = $food['image_base64'];
                    list($type, $imageData) = explode(';', $imageData);
                    list(, $imageData) = explode(',', $imageData);
                    $imageData = base64_decode($imageData);
                    $extension = explode('/', $type)[1];
                    $fileName = uniqid() . '.' . $extension;
                    $filePath = '/public/destination_food/' . $fileName;
                    Storage::disk('public')->put($filePath, $imageData);
                    $fullPath = Storage::url($filePath);
                }

                $savedFood[] = [
                    "id" => $food['id'],
                    "heading" => $food['heading'],
                    "description" => $food['description'],
                    "food_image" => $fileName,
                    "full_path" => $fullPath,
                    "created_at" => now()->toDateTimeString()
                ];
            }
            $validatedData['food'] = json_encode($savedFood, JSON_UNESCAPED_SLASHES);
        }
        #endregion


        $destination = Destination::create($validatedData);


         #region Featured Image
        $imagePathfeatured_image = $request->file('featured_image')->store('public/destination_images/' . uniqid());
        $featuredUrlFullPath = asset(Storage::url($imagePathfeatured_image));

        Asset::create([
            'referenceId' => $destination->id,
            'file_path' => $featuredUrlFullPath,
            'attachment_type' => "Destination Image",
            'IsFeatured_image' => true
        ]);

        #endregion


         #region higlight Image
        $imagePathHighlight_image = $request->file('highlight_image')->store('public/destination_highlight_images/' . uniqid());
        $highlightUrlFullPath = asset(Storage::url($imagePathHighlight_image));

        Asset::create([
            'referenceId' => $destination->id,
            'file_path' => $highlightUrlFullPath,
            'attachment_type' => "Destination Highlight Image",
            'IsFeatured_image' => false
        ]);

        #endregion


         #region visit time Image
        $imagePathVisit_image = $request->file('visit_time_image')->store('public/destination_visit_time_images/' . uniqid());
        $visitUrlFullPath = asset(Storage::url($imagePathVisit_image));

        Asset::create([
            'referenceId' => $destination->id,
            'file_path' => $visitUrlFullPath,
            'attachment_type' => "Destination Visit Time Image",
            'IsFeatured_image' => false
        ]);

        #endregion


        #region culture Image
        $imagePathCulture_image = $request->file('culture_image')->store('public/destination_culture_images/' . uniqid());
        $cultureUrlFullPath = asset(Storage::url($imagePathCulture_image));

        Asset::create([
            'referenceId' => $destination->id,
            'file_path' => $cultureUrlFullPath,
            'attachment_type' => "Destination Culture Image",
            'IsFeatured_image' => false
        ]);

        #endregion


        #region map Image
        $imagePathMap_image = $request->file('map_image')->store('public/destination_map_images/' . uniqid());
        $mapUrlFullPath = asset(Storage::url($imagePathMap_image));

        Asset::create([
            'referenceId' => $destination->id,
            'file_path' => $mapUrlFullPath,
            'attachment_type' => "Destination Map Image",
            'IsFeatured_image' => false
        ]);
        #endregion


        return redirect()->route('destinations')->with('success', 'Destinations Added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($destination_id)
    {
        // dd($destination_id);

        $destination = Destination::with('assets')->find($destination_id);

        $highlights = json_decode($destination->highlights, true);

        $visit_time = json_decode($destination->visit_time, true);

        $worth_a_visit = json_decode($destination->worth_a_visit, true);

        $culture = json_decode($destination->culture, true);

        $food = json_decode($destination->food, true);

        $destination_categories = DestinationCategory::all();

        $languages = Language::all();

        return view('pages.destinations.edit')->with(
            [
                'destination_categories' => $destination_categories,
                'destination' => $destination,
                'languages' => $languages,
                'highlights' => $highlights,
                'visit_times' => $visit_time,
                'worth_visit' => $worth_a_visit,
                'food' => $food,
                'culture' => $culture
            ]
        );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        //
    }

    public function destinationApi()
    {
        $destinations = Destination::with('assets')->get();
        return response()->json($destinations);
    }


     public function checkSlug(Request $request)
    {
        $slug = $request->query('slug');

        $exists = Destination::where('slug', $slug)->exists();

        return response()->json(['available' => !$exists]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\DestinationCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationCategoryRequest;
use App\Http\Requests\UpdateDestinationCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\Storage;

class DestinationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destination_categories = DestinationCategory::with('assets')->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.destination-category.index')->with('destination_categories', $destination_categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.destination-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'destination_category_name' => 'required',
        ]);

        $destinationCategory = DestinationCategory::create($validatedData);


        #region Featured Image
        $imagePathfeatured_image = $request->file('featured_image')->store('public/destination_category_images/' . uniqid());
        $featuredUrlFullPath = asset(Storage::url($imagePathfeatured_image));

        Asset::create([
            'referenceId' => $destinationCategory->id,
            'file_path' => $featuredUrlFullPath,
            'attachment_type' => "Destination Category Image",
            'IsFeatured_image' => true
        ]);
        #endregion


        return redirect()->route('destination-category')->with('success', 'Destination Category Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DestinationCategory $destinationCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($destination_category_id)
    {
        // dd($destination_category_id);

        $destination_category = DestinationCategory::with('assets')->find($destination_category_id);

        return view('pages.destination-category.edit')->with(
            [
                'destination_category' => $destination_category
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $destination_category_id)
    {
        $destination_category = DestinationCategory::with('assets')->find($destination_category_id);

        $featured_image_count = $destination_category->assets->filter(function ($asset) {
            return $asset->IsFeatured_image === 1;
        })->count();


        if ($featured_image_count > 1 && $request->hasFile('featured_image')) {
            return back()->with('error', 'Only ' . 1 . ' Featured image can be Uploaded');
        }

        if ($featured_image_count === 0) {
            $request->validate([
                'featured_image' => 'required',
            ]);
        }

        $validatedData = $request->validate([
            'destination_category_name' => 'required',
        ]);


        $destination_category->update($validatedData);


        if (!empty($request->file('featured_image'))) {

            $imagePathfeatured_image = $request->file('featured_image')->store('public/destination_category_images');
            $featuredUrlFullPath = asset(Storage::url($imagePathfeatured_image));
            Asset::updateOrCreate([
                'referenceId' => $destination_category->id,
                'file_path' => $featuredUrlFullPath,
                'attachment_type' => "Destination Category Image",
                'IsFeatured_image' => true
            ]);
        }

        return redirect()->route('destination-category')->with('success', 'Destination Category Updated successfully.');

        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestinationCategory $destinationCategory)
    {
        //
    }
}

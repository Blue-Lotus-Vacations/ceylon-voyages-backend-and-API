<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
    {
        $asset = Asset::find($id);

        if (!$asset) {
            return response()->json([
                'message' => 'Couldn\'t find asset',
                'success' => false
            ]);
        }

        $asset->delete();
        return response()->json([
            'message' => 'Asset deleted successfully',
            'success' => true
        ]);
    }
}

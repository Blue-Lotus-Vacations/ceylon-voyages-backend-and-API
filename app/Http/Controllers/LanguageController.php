<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::orderBy('created_at', 'desc')->paginate(10);

        // dd($languages);

        return view('pages.languages.index')->with('languages', $languages);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

         $validatedData = $request->validate([
            'language' => 'required',
            'language_code'=>'required'
        ]);

        $language = Language::create($validatedData);

        return redirect()->route('languages')->with('success', 'Languages Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($language_id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($language_id)
    {
        $language = Language::find($language_id);

        // dd($language);

        return view('pages.languages.edit')->with(
            [
                'language' => $language
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $language_id)
    {
        $language = Language::find($language_id);

        $validatedData = $request->validate([
            'language' => 'required',
            'language_code'=>'required'
        ]);

        $language->update($validatedData);

        return redirect()->route('languages')->with('success', 'Language Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        //
    }
}

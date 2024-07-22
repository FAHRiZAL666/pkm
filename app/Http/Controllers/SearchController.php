<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    // Retrieve query parameter
    $query = $request->input('query');

    // Perform search logic (query database or other data source)
    $results = Mall::where('nama_mall', 'like', "%$query%")->get();

    // Return JSON response
    return response()->json($results);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function show(Mall $mall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function edit(Mall $mall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mall $mall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mall $mall)
    {
        //
    }
}

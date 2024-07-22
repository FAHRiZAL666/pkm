<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Slot;
use App\Models\Users;
use App\Models\Lantai;
use App\Models\Mall;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kendaraan' => Kendaraan::all(),
            'slot' => Slot::all(),
            'mall' => Mall::all(),
            'lantai' => Lantai::all(),
            'users' => Users::all(),
            'title' => 'Dashboard',
        ];

        // Menggunakan compact
        // return view('dashboard', compact('dashboard'));

        // Atau menggunakan array asosiatif langsung
        return view('dashboard', $data);
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
     * @param  \App\Models\Kendaraan  $Kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $Kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kendaraan  $Kendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $Kendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $Kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kendaraan $Kendaraan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kendaraan  $Kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $Kendaraan)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'nama_slot' => 'required|string|max:5',
            'id_lantai' => 'required|integer',
            'status' => 'required|string|max:6',
        ]);

        Slot::create([
            'nama_slot' => $request->nama_slot,
            'id_lantai' => $request->id_lantai,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Slot parkir berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function show(Slot $slot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function edit(Slot $slot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_slot)
    {
        $request->validate([
            'nama_slot' => 'required|string|max:255',
            'status' => 'required|string|max:6',
        ]);

        $slot = Slot::findOrFail($id_slot);
        $slot->update([
            'nama_slot' => $request->nama_slot,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Slot parkir berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_slot)
{
    $slot = Slot::findOrFail($id_slot);
    $slot->delete();

    return redirect()->back()->with('success', 'Slot berhasil dihapus.');
}

}

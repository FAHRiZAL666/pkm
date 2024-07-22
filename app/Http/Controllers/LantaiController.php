<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Lantai;
use Illuminate\Http\Request;

class LantaiController extends Controller
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
            'nama_lantai' => 'required|string|max:5',
            'id_mall' => 'required|integer|exists:mall,id_mall', // pastikan id_mall disertakan dan valid
            'denah' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi untuk gambar
        ]);

        // Simpan gambar
        if ($request->hasFile('denah')) {
            $image = $request->file('denah');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/denah'), $imageName);
        }

        // Buat data lantai
        Lantai::create([
            'nama_lantai' => $request->nama_lantai,
            'id_mall' => $request->id_mall, // sertakan id_mall dalam data yang disimpan
            'denah' => $imageName, // simpan nama gambar di database
        ]);

        return back()->with('success', 'Lantai berhasil ditambahkan.');
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
    public function update(Request $request, $id_lantai)
    {
        $request->validate([
            'nama_lantai' => 'required|string|max:255',
            'denah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $lantai = Lantai::findOrFail($id_lantai);

        // Proses untuk gambar baru
        if ($request->hasFile('denah')) {
            // Hapus gambar lama jika ada
            if ($lantai->denah && file_exists(public_path('images/denah/' . $lantai->denah))) {
                unlink(public_path('images/denah/' . $lantai->denah));
            }

            // Simpan gambar baru
            $image = $request->file('denah');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/denah');
            $image->move($destinationPath, $name);

            // Perbarui nama gambar di database
            $lantai->denah = $name;
        }

        // Perbarui nama lantai
        $lantai->nama_lantai = $request->nama_lantai;
        $lantai->save();

        return redirect()->back()->with('success', 'Nama lantai berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_lantai)
    {
        $lantai = Lantai::findOrFail($id_lantai);

        // Hapus gambar jika ada
        if ($lantai->denah && file_exists(public_path('images/denah/' . $lantai->denah))) {
            unlink(public_path('images/denah/' . $lantai->denah));
        }

        $lantai->delete();

        return redirect()->back()->with('success', 'Lantai berhasil dihapus.');
    }
}

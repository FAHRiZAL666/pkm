<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use App\Models\Lantai;
use App\Models\Slot;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class MallController extends Controller
{
    public function index()
    {
        $data = [
            'mall' => Mall::all(),
            'title' => 'Data Mall',
        ];

        return view('mall.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mall' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        $input = $request->all();

        // Handle file upload if 'gambar' is present
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/mall'), $imageName);
            $input['gambar'] = $imageName;
        } else {
            // Jika tidak ada gambar yang diunggah, set nilai gambar ke default
            $input['gambar'] = 'mall.png'; // Atau sesuai dengan nama default gambar yang Anda gunakan
        }

        Mall::create($input);

        return redirect()->route('mall.index')->with('success', 'Mall berhasil ditambahkan.');
    }

    public function show(Mall $mall)
    {
        $data = [
            'slot' => Slot::all(),
            'lantai' => Lantai::where('id_mall', $mall->id_mall)->get(),
            'title' => 'Data Lantai',
        ];
        return view('mall.show', $data, compact('mall'));
    }

    public function update(Request $request, Mall $mall)
    {
        $request->validate([
            'nama_mall' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        $input = $request->all();

        // Handle file upload if 'gambar' is present
        if ($request->hasFile('gambar')) {
            $oldImagePath = public_path('images/mall/' . $mall->gambar);
            if ($mall->gambar && $mall->gambar !== 'mall.png' && File::exists($oldImagePath)) {
                // Attempt to delete the old image
                if (!File::delete($oldImagePath)) {
                    return redirect()->route('mall.index')->with('error', 'Foto lama tidak dapat dihapus.');
                }
            }
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/mall'), $imageName);
            $input['gambar'] = $imageName;

            // Check if the old image exists and is not the default image before deleting
        }

        $mall->update($input);

        return redirect()->route('mall.index')->with('success', 'Mall berhasil diperbarui.');
    }


    public function destroy(Mall $mall)
    {
        $oldImagePath = public_path('images/mall/' . $mall->gambar);
        if ($mall->gambar && $mall->gambar !== 'mall.png' && File::exists($oldImagePath)) {
            // Attempt to delete the old image
            if (!File::delete($oldImagePath)) {
                return redirect()->route('mall.index')->with('error', 'Foto lama tidak dapat dihapus.');
            }
        }

        $mall->delete();

        return redirect()->route('mall.index')->with('success', 'Mall berhasil dihapus.');
    }
}

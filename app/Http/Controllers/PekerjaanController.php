<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PekerjaanController extends Controller
{
    public function index(Request $request) {
        $keyword = $request->get('keyword');

        // PERUBAHAN PENTING DISINI:
        // Kita tambahkan 'withCount('pegawai')'.
        // Ini otomatis membuat variabel 'pegawai_count' di setiap data.
        $data = Pekerjaan::withCount('pegawai')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('deskripsi', 'like', "%{$keyword}%");
            })->paginate(10);

        return view('pekerjaan.index', compact('data'));
    }

    public function add() {
        return view('pekerjaan.add');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'captcha' => 'required|captcha',
        ]);

        if ($validator->fails()) return redirect()->back()->with($validator->errors()->all());

        $data = new Pekerjaan();
        $data->nama = $request->nama;
        $data->deskripsi = $request->deskripsi;
        // HAPUS baris penyimpanan jumlah_pegawai

        if ($data->save()) {
            return redirect()->route('pekerjaan.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('pekerjaan.index')->with('success', 'Data tidak tersimpan');
        }
    }

    public function edit(Request $request) {
        $data = Pekerjaan::findOrFail($request->id);
        return view('pekerjaan.edit', compact('data'));
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            // HAPUS validasi jumlah_pegawai
        ]);

        if ($validator->fails()) return redirect()->back()->with($validator->errors()->all());

        $data = Pekerjaan::findOrFail($request->id);

        $data->nama = $request->nama;
        $data->deskripsi = $request->deskripsi;
        // HAPUS baris update jumlah_pegawai (Ini yang bikin error edit tadi!)

        if ($data->save()) {
            return redirect()->route('pekerjaan.index')->with('success', 'Data tersimpan');
        } else {
            return redirect()->route('pekerjaan.index')->with('success', 'Data tidak tersimpan');
        }
    }

    public function destroy(Request $request) {
        Pekerjaan::findOrFail($request->id)->delete();
        return redirect()->route('pekerjaan.index')->with('success', 'Data terhapus');
    }
}

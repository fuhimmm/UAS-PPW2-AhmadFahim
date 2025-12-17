<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $data = Pegawai::with('pekerjaan')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('email', 'like', "%{$keyword}%")
                      ->orWhere('nomor_telepon', 'like', "%{$keyword}%");
            })
            ->paginate(10);

        return view('pegawai.index', compact('data'));
    }

    // FORM CREATE
    public function create()
    {

        $pekerjaan = Pekerjaan::all();
        return view('pegawai.create', compact('pekerjaan'));
    }

    // ACTION STORE (SIMPAN)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'pekerjaan_id' => 'required|exists:pekerjaan,id'
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Berhasil menambahkan data pegawai!');
    }

    // FORM EDIT
    public function edit($id)
    {
        $data = Pegawai::findOrFail($id);
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.edit', compact('data', 'pekerjaan'));
    }

    // ACTION UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email,'.$id,
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'pekerjaan_id' => 'required|exists:pekerjaan,id'
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Berhasil mengubah data pegawai!');
    }
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete(); // Ini otomatis Soft Delete karena Model sudah disetting

        return redirect()->route('pegawai.index')->with('success', 'Berhasil menghapus data pegawai!');
    }
}

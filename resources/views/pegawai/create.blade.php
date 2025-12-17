@extends('base')
@section('title', 'Tambah Pegawai')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Pegawai Baru</h2>

    <form action="{{ route('pegawai.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="nama" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan / Jabatan</label>
            <select name="pekerjaan_id" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Pilih Pekerjaan --</option>
                @foreach($pekerjaan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">No. Telepon</label>
                <input type="text" name="nomor_telepon" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
            <textarea name="alamat" rows="3" class="w-full px-3 py-2 border rounded-lg" required></textarea>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('pegawai.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection

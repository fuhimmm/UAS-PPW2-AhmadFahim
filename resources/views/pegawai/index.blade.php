@extends('base')
@section('title', 'Daftar Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')

@section('content')
    <section class="p-4 bg-white rounded-lg min-h-[50vh]">
        <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">Data Pegawai</h1>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-700 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('pegawai.create') }}" class="rounded-md bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
                    + Tambah Pegawai
                </a>

                <form class="flex w-full max-w-sm gap-2" action="{{ route('pegawai.index') }}" method="GET">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari nama/email..." class="w-full rounded-md border px-3 py-2 text-sm">
                    <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                        Cari
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-x divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Pekerjaan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">No. Telepon</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Alamat</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($data as $key => $d)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $data->firstItem() + $key }}</td>

                            <td class="px-4 py-3 font-medium text-gray-900">{{ $d->nama }}</td>

                            <td class="px-4 py-3">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ $d->pekerjaan->nama ?? '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-gray-600">{{ $d->email }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $d->nomor_telepon }}</td>
                            <td class="px-4 py-3 text-gray-600 truncate max-w-xs" title="{{ $d->alamat }}">{{Str::limit($d->alamat, 20)}}</td>

                            <td class="px-4 py-3 text-center">
                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <a href="{{ route('pegawai.edit', $d->id) }}" class="px-3 py-1.5 text-xs font-medium text-blue-600 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100">
                                        Edit
                                    </a>
                                    <form action="{{ route('pegawai.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Hapus data pegawai ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-600 bg-white border border-l-0 border-gray-300 rounded-r-lg hover:bg-gray-100">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">Belum ada data pegawai.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $data->links() }}
            </div>

        </div>
    </section>
@endsection

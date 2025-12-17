@extends('base')
@section('title', 'Dashboard')
@section('menuberanda', 'underline decoration-4 underline-offset-7')

@section('content')
<section class="p-6 bg-white rounded-lg shadow-md min-h-[50vh]">
    <h1 class="text-3xl font-bold text-[#C0392B] mb-2 text-center">Dashboard</h1>
    <p class="text-center text-gray-600 mb-8">Grafik Jumlah Pegawai Berdasarkan Pekerjaan</p>

    <div class="w-full max-w-3xl mx-auto">
        <canvas id="grafikPegawai"></canvas>
    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('grafikPegawai');

    new Chart(ctx, {
        type: 'bar', // Jenis grafik: Bar (Batang)
        data: {
            // Mengambil data label dari Controller (menggunakan json_encode biar aman)
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Pegawai',
                // Mengambil data angka dari Controller
                data: {!! json_encode($data) !!},
                borderWidth: 1,
                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Warna batang biru transparan
                borderColor: 'rgba(54, 162, 235, 1)',     // Garis tepi biru
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true, // Mulai dari angka 0
                    ticks: {
                        stepSize: 1 // Supaya angkanya bulat (1, 2, 3), bukan desimal (1.5 orang)
                    }
                }
            }
        }
    });
</script>
@endsection

@extends('layouts.admin')

@section('title', 'Rekap Gaji Harian')
@section('page-title', 'Rekap Gaji Harian')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-8 text-center">
    <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <h1 class="text-xl font-bold text-slate-800 mb-2">Halaman Rekap Gaji Harian</h1>
    <p class="text-slate-500 text-sm">Halaman ini akan menampilkan rekap perhitungan gaji harian karyawan.</p>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Rekap Gaji Bulanan')
@section('page-title', 'Rekap Gaji Bulanan')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-8 text-center">
    <div class="w-16 h-16 rounded-2xl bg-purple-50 flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    </div>
    <h1 class="text-xl font-bold text-slate-800 mb-2">Halaman Rekap Gaji Bulanan</h1>
    <p class="text-slate-500 text-sm">Halaman ini akan menampilkan rekap perhitungan gaji bulanan seluruh karyawan.</p>
</div>
@endsection

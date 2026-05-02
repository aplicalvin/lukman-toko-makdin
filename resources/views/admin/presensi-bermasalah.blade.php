@extends('layouts.admin')

@section('title', 'Presensi Bermasalah')
@section('page-title', 'Presensi Bermasalah')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-8 text-center">
    <div class="w-16 h-16 rounded-2xl bg-amber-50 flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
    </div>
    <h1 class="text-xl font-bold text-slate-800 mb-2">Halaman Presensi Bermasalah</h1>
    <p class="text-slate-500 text-sm">Halaman ini akan menampilkan daftar presensi yang bermasalah atau perlu ditinjau.</p>
</div>
@endsection

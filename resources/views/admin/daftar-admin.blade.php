@extends('layouts.admin')

@section('title', 'Daftar Admin')
@section('page-title', 'Daftar Admin')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-8 text-center">
    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <h1 class="text-xl font-bold text-slate-800 mb-2">Halaman Daftar Admin</h1>
    <p class="text-slate-500 text-sm">Halaman ini akan menampilkan daftar pengguna yang memiliki akses admin.</p>
</div>
@endsection

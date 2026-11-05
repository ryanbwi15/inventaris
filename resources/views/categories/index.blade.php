{{-- Memanggil layout app.blade --}}
@extends('layouts.app')

{{-- Judul halaman --}}
@section('title', 'Data Kategori')

{{-- Section content --}}
@section('content')

{{-- Header Halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">{{ $judul }}</h1>
        <p class="text-muted mb-0 small">
            Kelola kategori barang inventaris.
        </p>
    </div>

    <a href="{{ route('categories.create') }}"
        class="btn btn-primary px-3 text-nowrap">
        <i class="fa-solid fa-plus me-1"></i>
        Tambah Kategori
    </a>
</div>

{{-- Pesan Flash Sukses --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close"
            data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Pesan Flash Gagal --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm">
        <i class="fa-solid fa-circle-exclamation me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close"
            data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Card Daftar Kategori --}}
<div class="card border-0 shadow-sm">

    {{-- Card Header --}}
    <div class="card-header bg-white border-0 p-4">
        <div>
            <h5 class="fw-bold mb-1">Daftar Kategori</h5>
            <small class="text-muted">
                Total {{ $categories->count() }} kategori
            </small>
        </div>
    </div>

    {{-- Tabel Kategori --}}
    <div class="card-body p-0">
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                {{-- Header Tabel --}}
                <thead class="table-light">
                    <tr class="small text-muted">
                        <th class="text-center py-3" width="65">NO</th>
                        <th class="py-3" width="25%">NAMA KATEGORI</th>
                        <th class="py-3">DESKRIPSI</th>
                        <th class="text-center py-3" width="120">AKSI</th>
                    </tr>
                </thead>

                {{-- Isi Tabel --}}
                <tbody>
                    @forelse ($categories as $category)
                        <tr>

                            {{-- Nomor --}}
                            <td class="text-center text-muted small">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Nama Kategori --}}
                            <td class="fw-semibold">
                                {{ $category->name }}
                            </td>

                            {{-- Deskripsi --}}
                            <td>
                                @if ($category->description)
                                    <span class="text-muted">
                                        {{ $category->description }}
                                    </span>
                                @else
                                    <span class="text-muted fst-italic small">
                                        Tidak ada deskripsi
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="d-flex justify-content-center gap-1">

                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Ubah kategori">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus kategori">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="fa-solid fa-tags fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">
                                    Belum ada data kategori.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection
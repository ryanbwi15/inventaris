{{-- Memanggil layout app.blade --}}
@extends('layouts.app')

{{-- Judul halaman --}}
@section('title', 'Data Barang')

{{-- Section content --}}
@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <h1 class="h3 mb-0">{{ $judul }}</h1>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('items.pdf', request()->query()) }}"
                target="_blank"
                class="btn btn-outline-danger">
                <i class="fa-solid fa-file-pdf me-1"></i>
                Cetak PDF
            </a>
            
        <a href="{{ route('items.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah Barang
        </a>
    </div>

</div>

{{-- Pesan Flash Sukses --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Pesan Flash Gagal --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-exclamation me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Card Daftar Barang --}}
<div class="card shadow-sm border-0">

    <div class="card-header bg-white border-0 p-4">
        <div class="row align-items-center g-3">
            <div class="col-md-5">
                <h5 class="fw-bold mb-1">Daftar Barang</h5>
                <small class="text-muted">
                    Total {{ $item->total() }} data barang
                </small>
            </div>
            <div class="col-md-7">
                {{-- Form Pencarian --}}
                <form method="GET" action="{{ route('items.index') }}"
                    class="d-flex gap-2"
                    style="max-width: 500px; width: 100%;">
    
                    <input type="text" name="q"
                        value="{{ $search }}"
                        class="form-control"
                        placeholder="Cari nama barang atau kategori...">
    
                    <button type="submit" class="btn btn-primary text-nowrap px-3" style="min-width: 90px;">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Cari
                    </button>
    
                    @if ($search)
                        <a href="{{ route('items.index') }}"
                            class="btn btn-secondary">
                            Reset
                        </a>
                    @endif
    
                </form>
            </div>

        </div>
    </div>

    {{-- Tabel Barang --}}
    <div class="card-body p-0">
        <div class="table-responsive">
<table class="table table-hover align-middle mb-0">

    {{-- Header Tabel --}}
    <thead class="table-light">
        <tr class="small text-muted">
            <th class="text-center" style="width: 55px;">No</th>
            <th style="width: 16%;">Kategori</th>
            <th style="width: 25%;">Nama Barang</th>
            <th class="text-center" style="width: 10%;">Stok</th>
            <th class="text-end" style="width: 16%;">Harga Satuan</th>
            <th class="text-center" style="width: 100px;">Foto</th>
            <th class="text-center" style="width: 120px;">Aksi</th>
        </tr>
    </thead>

    {{-- Isi Tabel --}}
    <tbody>
        @forelse ($item as $i)
            <tr>

                {{-- Nomor --}}
                <td class="text-center text-muted small">
                    {{ $item->firstItem() + $loop->index }}
                </td>

                {{-- Kategori --}}
                <td>
                    <span class="badge bg-light text-dark border fw-normal">
                        {{ $i->category->name }}
                    </span>
                </td>

                {{-- Nama Barang --}}
                <td class="fw-semibold">
                    {{ $i->name }}
                </td>

                {{-- Stok --}}
                <td class="text-center">
                    <span class="badge bg-primary-subtle text-primary">
                        {{ $i->stock }}
                    </span>
                </td>

                {{-- Harga --}}
                <td class="text-end text-nowrap">
                    Rp {{ number_format($i->price, 0, ',', '.') }}
                </td>

                {{-- Foto --}}
                <td class="text-center">
                    @if ($i->photo)
                        <img
                            src="{{ asset('storage/' . $i->photo) }}"
                            alt="{{ $i->name }}"
                            class="rounded border"
                            style="width: 48px; height: 48px; object-fit: cover; cursor: pointer;"
                            data-bs-toggle="modal"
                            data-bs-target="#previewFoto{{ $i->id }}">
                    @else
                        <span class="text-muted small">-</span>
                    @endif
                </td>

                {{-- Aksi --}}
                <td>
                    <div class="d-flex justify-content-center gap-1">

                        <a href="{{ route('items.edit', $i) }}"
                            class="btn btn-sm btn-outline-warning"
                            title="Ubah data">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('items.destroy', $i) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-sm btn-outline-danger"
                                title="Hapus data">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>

                    </div>
                </td>

            </tr>

        @empty
            <tr>
                <td colspan="7" class="text-center py-5">
                    <i class="fa-solid fa-box-open fa-2x text-muted mb-2"></i>
                    <p class="text-muted mb-0">
                        Data barang tidak ditemukan.
                    </p>
                </td>
            </tr>
        @endforelse
    </tbody>

</table>
        </div>
    </div>

    {{-- Pagination --}}
    @if ($item->hasPages())
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <small class="text-muted">
                    Menampilkan {{ $item->firstItem() ?? 0 }}
                    sampai {{ $item->lastItem() ?? 0 }}
                    dari {{ $item->total() }} data
                </small>

                {{ $item->links() }}

            </div>
        </div>
    @endif

</div>

{{-- Modal Preview Foto --}}
@foreach ($item as $i)
    @if ($i->photo)
        <div class="modal fade"
            id="previewFoto{{ $i->id }}"
            tabindex="-1"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">{{ $i->name }}</h5>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body text-center">
                        <img
                            src="{{ asset('storage/' . $i->photo) }}"
                            alt="{{ $i->name }}"
                            class="img-fluid rounded"
                            style="max-height: 70vh;">
                    </div>

                </div>
            </div>
        </div>
    @endif
@endforeach
@endsection
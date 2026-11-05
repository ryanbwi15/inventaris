
@extends('layouts.app')
@section('title', 'Tambah Data Barang')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-4">{{ $judul }}</h1>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Form Tambah Data Barang</h5>
    </div>
    <div class="card-body">
        {{-- Pesan Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="category_id" class="form-select">
                <option value="">-- Pilih kategori --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $item->category_id ?? null) == $category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
             @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">
                    Nama Barang
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Masukkan nama barang"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">
                    Stok
                </label>
                <input
                    type="number"
                    name="stock"
                    id="stock"
                    class="form-control @error('stock') is-invalid @enderror"
                    value="{{ old('stock') }}"
                    required
                >
                @error('stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">
                    Harga
                </label>
                <input
                    type="number"
                    name="price"
                    id="price"
                    class="form-control @error('price') is-invalid @enderror"
                    placeholder="Masukkan Harga Barang"
                    value="{{ old('price') }}"
                    required
                >
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Foto Barang</label>
                <input type="file" name="photo" id="photo" 
                class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                @error('photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                 <a href="{{ route('items.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left-long"></i> Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

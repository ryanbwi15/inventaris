@extends('layouts.app')

@section('title', 'Ubah Data Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-4">{{ $judul }}</h1>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Form Ubah Data Barang</h5>
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

        <form action="{{ route('items.update', $item) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- Nama Barang --}}
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
                    value="{{ old('name', $item->name) }}"
                >

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">
                    Kategori
                </label>

                <select
                    name="category_id"
                    id="category_id"
                    class="form-select @error('category_id') is-invalid @enderror"
                >
                    <option value="">-- Pilih Kategori --</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id', $item->category_id) == $category->id)
                        >
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

            {{-- Stok --}}
            <div class="mb-3">
                <label for="stock" class="form-label">
                    Stok Barang
                </label>

                <input
                    type="number"
                    name="stock"
                    id="stock"
                    class="form-control @error('stock') is-invalid @enderror"
                    placeholder="Masukkan jumlah stok"
                    min="0"
                    value="{{ old('stock', $item->stock) }}"
                >

                @error('stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Harga --}}
            <div class="mb-3">
                <label for="price" class="form-label">
                    Harga Satuan
                </label>

                <input
                    type="number"
                    name="price"
                    id="price"
                    class="form-control @error('price') is-invalid @enderror"
                    placeholder="Masukkan harga barang"
                    min="0"
                    value="{{ old('price', $item->price) }}"
                >

                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Foto Lama --}}
            <div class="mb-3">
                <label class="form-label">Foto Saat Ini</label>
                <div>
                    @if ($item->photo)
                        <img
                            src="{{ asset('storage/' . $item->photo) }}"
                            alt="{{ $item->name }}"
                            class="img-thumbnail"
                            style="width: 120px; height: 120px; object-fit: cover;"
                        >
                    @else
                        <span class="text-muted">Belum ada foto.</span>
                    @endif
                </div>
            </div>

            {{-- Upload Foto Baru --}}
            <div class="mb-3">
                <label for="photo" class="form-label">
                    Ganti Foto Barang
                </label>

                <input
                    type="file"
                    name="photo"
                    id="photo"
                    class="form-control @error('photo') is-invalid @enderror"
                    accept="image/*"
                >

                <div class="form-text">
                    Kosongkan jika tidak ingin mengganti foto.
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                </div>

                @error('photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('items.index') }}"
                   class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
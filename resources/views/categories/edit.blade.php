
@extends('layouts.app')
@section('title', 'Ubah Data Kategori')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-4">{{ $judul }}</h1>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Form Ubah Data Kategori</h5>
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
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">
                    Nama Kategori
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Masukkan nama kategori"
                    value="{{ old('name', $category->name) }}"
                >
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea
                name="description"
                id="description"
                class="form-control @error('description') is-invalid @enderror"
                rows="4" placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="d-flex justify-content-end gap-2 mt-4">
                 <a href="{{ route('categories.index') }}" class="btn btn-secondary">
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

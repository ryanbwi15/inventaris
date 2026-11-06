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

            @include('items._form')

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
<div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Pilih kategori --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $item->category_id ?? '') == $category->id)>
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
                    value="{{ old('name', $item->name ?? '') }}"
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
                    value="{{ old('stock', $item->stock ?? '') }}"
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
                    value="{{ old('price', $item->price ?? '') }}"
                    required
                >
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Foto Lama: hanya tampil saat update dan foto tersedia --}}
@if (!empty($item?->photo))
    <div class="mb-3">
        <label class="form-label">Foto Saat Ini</label>
        <div>
            <img
                src="{{ asset('storage/' . $item->photo) }}"
                alt="{{ $item->name }}"
                class="img-thumbnail"
                style="width: 120px; height: 120px; object-fit: cover;"
            >
        </div>
    </div>
@endif

{{-- Upload Foto --}}
<div class="mb-3">
    <label for="photo" class="form-label">
        {{ !empty($item?->photo) ? 'Ganti Foto Barang' : 'Upload Foto Barang' }}
    </label>

    <input
        type="file"
        name="photo"
        id="photo"
        class="form-control @error('photo') is-invalid @enderror"
        accept="image/jpeg,image/png,image/webp"
    >

    <div class="form-text">
        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
        @if (!empty($item?->photo))
            Kosongkan jika tidak ingin mengganti foto.
        @endif
    </div>

    @error('photo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
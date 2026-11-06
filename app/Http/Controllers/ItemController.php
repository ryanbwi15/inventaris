<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Category;
use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        // Pencarian
        $judul = 'Data Barang';
        $search = $request->q;
        $item = Item::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('name')
            ->paginate(2)
            ->withQueryString();

        return view('items/index', compact('judul', 'item', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $judul = 'Tambah Data Barang';
        // Mengambil seluruh data kategori
        $categories = Category::all();

        return view('items/create', compact('judul', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(StoreItemRequest $request)
    {
        $data = $request->validated();

        // Upload foto jika tersedia
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('items', 'public');
        }

        Item::create($data);

        return redirect()->route('items.index')
            ->with('success', 'Data Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @return void
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit(Item $item)
    {
        $judul = 'Edit Data Barang';
        $categories = Category::orderBy('name')->get();

        return view('items.edit', compact('judul', 'item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Jika ada foto baru yang diunggah
        if ($request->hasFile('photo')) {

            // Hapus foto lama
            if ($item->photo) {
                Storage::disk('public')->delete($item->photo);
            }

            // Simpan foto baru
            $data['photo'] = $request->file('photo')
                ->store('items', 'public');
        }

        $item->update($data);

        return redirect()->route('items.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(Item $item)
    {
        // Hapus foto dari storage jika ada
        if ($item->photo) {
            Storage::disk('public')->delete($item->photo);
        }

        // Hapus data barang dari database
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Data Barang dihapus.');
    }

    /**
     * Stream a PDF report of inventory items.
     *
     * @return Response
     */
    public function cetakPdf(Request $request)
    {
        $search = $request->q;
        $item = Item::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($category) use ($search) {
                            $category->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('name')
            ->get();

        $totalStok = $item->sum('stock');
        $totalNilai = $item->sum(function ($i) {
            return $i->stock * $i->price;
        });
        $pdf = Pdf::loadView('items.pdf', compact(
            'item',
            'search',
            'totalStok',
            'totalNilai'
        ));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-data-barang.pdf');
    }
}

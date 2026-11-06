<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $judul = 'Data Kategori Barang';
        $categories = Category::withCount('items')
            ->latest()
            ->paginate(10);

        return view('categories/index', compact('judul', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $judul = 'Tambah Data Kategori Barang';

        return view('categories/create', compact('judul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100|unique:categories,name',
            'description' => 'nullable',
        ]);
        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @return void
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit(Category $category)
    {
        $judul = 'Edit Data Kategori Barang';

        return view('categories.edit', compact('judul', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable',
        ]);
        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori dihapus.');
    }
}

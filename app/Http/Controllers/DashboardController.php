<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the inventory dashboard and its summary.
     *
     * @return View
     */
    public function index()
    {
        $judul = 'Dashboard Inventaris';
        $ringkasan = ['kategori' => 5, 'barang' => 28];

        return view('dashboard', compact('judul', 'ringkasan'));
    }
}

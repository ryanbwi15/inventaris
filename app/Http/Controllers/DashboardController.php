<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //menampilkan index Dashboard
    public function index()
    {
        $judul = 'Dashboard Inventaris';
        $ringkasan = ['kategori' => 5, 'barang' => 28];
        return view('dashboard', compact('judul', 'ringkasan'));
    }
}

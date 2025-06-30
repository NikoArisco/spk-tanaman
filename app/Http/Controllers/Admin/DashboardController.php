<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Contoh mengambil data untuk dikirim ke view
        $jumlahUser = User::count();
        $jumlahKriteria = 5; // Angka statis atau dari model lain
        $jumlahTanaman = 3;  // Angka statis atau dari model lain

        // Mengirim data ke view menggunakan array asosiatif
        return view('dashboard.index', [
            'userCount' => $jumlahUser,
            'criteriaCount' => $jumlahKriteria,
            'plantCount' => $jumlahTanaman,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

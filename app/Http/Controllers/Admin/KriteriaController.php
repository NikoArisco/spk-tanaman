<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        $totalBobot = $kriteria->sum('bobot');

        return view('admin.kriteria.index', compact('kriteria', 'totalBobot'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'nullable|string|max:10',
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0.01|max:1',
            'tipe' => 'required|in:benefit,cost',
        ]);

        $currentTotalWeight = Kriteria::sum('bobot');
        $newTotalWeight = $currentTotalWeight + (float) $request->bobot;

        if (round($newTotalWeight, 4) > 1.0) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Total bobot seluruh kriteria tidak boleh melebihi 1.0 (100%). Akumulasi saat ini jika ditambah: " . round($newTotalWeight, 2));
        }

        Kriteria::create($request->all());

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Data kriteria berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriterium)
    {
        return view('admin.kriteria.edit', ['kriteria' => $kriterium]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriterium)
    {
        $request->validate([
            'kode' => 'nullable|string|max:10',
            'nama_kriteria' => 'required|string|max:255|unique:kriteria,nama_kriteria,' . $kriterium->id,
            'bobot' => 'required|numeric|min:0.01|max:1',
            'tipe' => 'required|in:benefit,cost',
        ]);

        $otherTotalWeight = Kriteria::where('id', '!=', $kriterium->id)->sum('bobot');
        $newTotalWeight = $otherTotalWeight + (float) $request->bobot;

        if (round($newTotalWeight, 4) > 1.0) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Total bobot seluruh kriteria tidak boleh melebihi 1.0 (100%). Akumulasi saat ini jika diperbarui: " . round($newTotalWeight, 2));
        }

        $kriterium->update($request->all());

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Data kriteria berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Data kriteria berhasil dihapus.');
    }
}

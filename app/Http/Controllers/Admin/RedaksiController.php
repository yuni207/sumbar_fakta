<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redaksi;
use Illuminate\Http\Request;

class RedaksiController extends Controller
{
    /**
     * LIST DATA REDAKSI
     */
    public function index()
    {
        $redaksis = Redaksi::orderBy('urutan', 'asc')->get();

        return view('admin.redaksi.index', compact('redaksis'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('admin.redaksi.add');
    }

    /**
     * SIMPAN DATA
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:100',
            'email' => 'required|email|unique:redaksi,email',
            'urutan' => 'required|integer',
        ]);

        Redaksi::create($request->all());

        return redirect()->route('admin.redaksi.index')
            ->with('success', 'Redaksi berhasil ditambahkan!');
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $redaksi = Redaksi::findOrFail($id);

        return view('admin.redaksi.edit', compact('redaksi'));
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:100',
            'email' => 'required|email|unique:redaksi,email,' . $id,
            'urutan' => 'nullable|integer',
        ]);

        $redaksi = Redaksi::findOrFail($id);

        $redaksi->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'urutan' => $request->urutan ?? $redaksi->urutan,
        ]);

        return redirect()->route('admin.redaksi.index')
            ->with('success', 'Data redaksi berhasil diupdate');
    }

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        Redaksi::findOrFail($id)->delete();

        return back()->with('success', 'Anggota redaksi dihapus');
    }

    public function frontend()
    {
        $redaksis = Redaksi::orderBy('urutan', 'asc')->get();

        return view('redaksi.index', compact('redaksis'));
    }
}

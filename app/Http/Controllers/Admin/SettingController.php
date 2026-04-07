<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.index', compact('setting'));
    }

    public function create()
    {
        return view('admin.setting.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'email' => 'required|email',
            'tagline' => 'required',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif,ico|max:2048',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'iklan' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->except('_token');

        // Proses Upload
        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('images', 'public');
        }

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('images', 'public');
        }

        if ($request->hasFile('iklan')) {
            $data['iklan'] = $request->file('iklan')->store('images', 'public');
        }

        Setting::create($data);

        return redirect()->route('admin.setting.index')->with('success', 'Identitas berhasil disimpan!');
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'title'   => 'required',
            'email'   => 'required|email',
            'tagline' => 'required',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico|max:2048',
            'logo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'iklan'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // ✅ Hanya ambil field teks dulu
        $data = $request->only(['title', 'tagline', 'email']);

        // ✅ Update Favicon hanya jika ada file baru
        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('images', 'public');
        }

        // ✅ Update Logo hanya jika ada file baru
        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('images', 'public');
        }

        // ✅ Update Iklan hanya jika ada file baru
        if ($request->hasFile('iklan')) {
            if ($setting->iklan) {
                Storage::disk('public')->delete($setting->iklan);
            }
            $data['iklan'] = $request->file('iklan')->store('images', 'public');
        }

        $setting->update($data);

        return redirect()->route('admin.setting.index')
            ->with('success', 'Identitas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);

        // Hapus semua file terkait di storage
        if ($setting->favicon) Storage::disk('public')->delete($setting->favicon);
        if ($setting->logo) Storage::disk('public')->delete($setting->logo);
        if ($setting->iklan) Storage::disk('public')->delete($setting->iklan);

        $setting->delete();
        return redirect()->route('admin.setting.index')->with('success', 'Identitas berhasil dihapus!');
    }
}

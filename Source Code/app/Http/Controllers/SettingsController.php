<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::first();

        // Bagikan ke semua view
        \View::share('settings', $settings);

        return view('settings.index', compact('settings'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'profile_photo' => 'nullable|image|max:2048'
        ]);

        // Update foto
        if ($request->hasFile('profile_photo')) {
            $filename = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->storeAs('public/profile', $filename);
            $user->profile_photo = $filename;
        }

        $user->update($request->only('name','email'));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|confirmed'
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }


    public function updateWarehouse(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'nullable|string',
            'warehouse_address' => 'nullable|string',
            'warehouse_phone' => 'nullable|string',
            'warehouse_logo' => 'nullable|image|max:2048'
        ]);

        $setting = Setting::first() ?? new Setting();

        if ($request->hasFile('warehouse_logo')) {
            $logoName = 'logo_'.time().'.'.$request->warehouse_logo->extension();
            $request->warehouse_logo->storeAs('public/logo', $logoName);
            $setting->warehouse_logo = $logoName;
        }

        $setting->warehouse_name = $request->warehouse_name;
        $setting->warehouse_address = $request->warehouse_address;
        $setting->warehouse_phone = $request->warehouse_phone;

        $setting->save();

        return back()->with('success', 'Informasi gudang berhasil diperbarui.');
    }


    public function toggleDarkMode()
    {
        $user = auth()->user();
        $user->dark_mode = !$user->dark_mode;
        $user->save();

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Helpers\ImageManager;
use Illuminate\Support\Facades\Storage;

class SystemSettingController extends Controller
{
    public function index()
    {
        $settings = [];
        $settingRecords = Setting::all();

        // Convert to key-value array for easier access in the view
        foreach ($settingRecords as $setting) {
            $settings[$setting->type] = $setting->value;
        }
        // dd($settings);

        return view('admin.backends.setting.index', compact('settings'));
    }

    public function SystemSettingUpdate(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'copy_right_text' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'favicon' => 'nullable|image|mimes:jpeg,png,jpg,ico|max:2048',
            ]);

            // Update or create each setting
            $this->updateOrCreateSetting('name', $request->name);
            $this->updateOrCreateSetting('email', $request->email);
            $this->updateOrCreateSetting('copy_right_text', $request->copy_right_text);
            $this->updateOrCreateSetting('phone', $request->phone);
            $this->updateOrCreateSetting('address', $request->address);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoPath = ImageManager::upload($request->file('logo'), 'settings');
                $this->updateOrCreateSetting('logo', $logoPath);
            }


            // Handle favicon upload
            if ($request->hasFile('favicon')) {
               $logoPath = ImageManager::upload($request->file('favicon'), 'settings');
                $this->updateOrCreateSetting('favicon', $logoPath);
            }

            // Return JSON if AJAX
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'System settings updated successfully!']);
            }

            // Default redirect (non-AJAX)
        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
            }
        }
    }

    /**
     * Helper method to update or create a setting
     */
    private function updateOrCreateSetting($type, $value)
    {
        Setting::updateOrCreate(
            ['type' => $type],
            ['value' => $value]
        );
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LocalizationController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale');

        if (!in_array($locale, ['ru', 'uz'])) {
            return redirect()->back()->with('error', 'Неверный язык');
        }

        $settingsPath = storage_path('app/settings.json');

        // Читаем текущие настройки
        $settings = File::exists($settingsPath)
            ? json_decode(File::get($settingsPath), true)
            : [];

        $settings['locale'] = $locale;

        File::put($settingsPath, json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Manual;

class ManualController extends Controller
{
    public function redirectShortLink(string $shortCode)
    {
        $manualId = (int) base_convert($shortCode, 36, 10);
        $manual = Manual::findOrFail($manualId);

        return redirect()->route('manual.show', [
            'brandId' => $manual->brand_id,
            'brandSlug' => $manual->brand->getNameUrlEncodedAttribute(),
            'manualId' => $manual->id,
        ]);
    }

    public function show(string $brandId, string $brandSlug, string $manualId)
    {
        $brand = Brand::findOrFail($brandId);
        $manual = Manual::findOrFail($manualId);

        $manual->increment('views');

        return view('pages/manual_view', [
            "manual" => $manual,
            "brand" => $brand,
        ]);
    }
}

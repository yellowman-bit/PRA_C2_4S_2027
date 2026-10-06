<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class BrandController extends Controller
{
    public function show($brand_id, $brand_slug)
    {

        $brand = Brand::findOrFail($brand_id);
        $popularManuals = Manual::where('brand_id', $brand_id)
            ->orderByDesc('views')
            ->orderBy('id')
            ->limit(5)
            ->get();
        $manuals = Manual::where('brand_id', $brand_id)->get();

        return view('pages/manual_list', [
            "brand" => $brand,
            "popularManuals" => $popularManuals,
            "manuals" => $manuals
        ]);

    }
}

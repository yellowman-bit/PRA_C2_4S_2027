<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Manual;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ManualController extends Controller
{
    public function create(): View
    {
        return view('admin.manuals.create', [
            'brands' => Brand::orderBy('name')->get(),
            'types' => Type::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'type_id' => ['nullable', 'required_without:new_type', 'integer', 'exists:types,id', 'prohibits:new_type'],
            'new_type' => ['nullable', 'required_without:type_id', 'string', 'max:255', 'unique:types,name', 'prohibits:type_id'],
            'name' => ['required', 'string', 'max:255'],
            'filesize' => ['required', 'integer', 'min:0'],
            'originUrl' => ['required', 'url', 'max:65535'],
            'filename' => ['nullable', 'string', 'max:255'],
            'downloadedServer' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated): void {
            $manual = Manual::create([
                'brand_id' => $validated['brand_id'],
                'name' => $validated['name'],
                'filesize' => $validated['filesize'],
                'originUrl' => $validated['originUrl'],
                'filename' => $validated['filename'] ?? null,
                'downloadedServer' => $validated['downloadedServer'] ?? null,
            ]);

            $type = isset($validated['new_type'])
                ? Type::create(['name' => $validated['new_type']])
                : Type::findOrFail($validated['type_id']);

            $manual->types()->attach($type);
        });

        return redirect()
            ->route('admin.manuals.create')
            ->with('status', 'De handleiding is toegevoegd.');
    }
}

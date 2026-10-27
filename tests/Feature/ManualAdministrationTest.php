<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Manual;
use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManualAdministrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_manual_can_be_created_with_a_type_and_nullable_fields_left_empty(): void
    {
        $brand = new Brand;
        $brand->name = 'Test brand';
        $brand->save();
        $type = Type::create(['name' => 'Test type']);

        $response = $this->post(route('admin.manuals.store'), [
            'brand_id' => $brand->id,
            'type_id' => $type->id,
            'name' => 'Test manual',
            'filesize' => 1024,
            'originUrl' => 'https://example.com/manual.pdf',
            'filename' => '',
            'downloadedServer' => '',
        ]);

        $manual = Manual::where('name', 'Test manual')->firstOrFail();

        $response->assertRedirect(route('admin.manuals.create'));
        $this->assertDatabaseHas('manuals', [
            'id' => $manual->id,
            'filename' => null,
            'downloadedServer' => null,
        ]);
        $this->assertDatabaseHas('manual_type', [
            'manual_id' => $manual->id,
            'type_id' => $type->id,
        ]);
    }

    public function test_manual_form_lists_brands_and_types(): void
    {
        $brand = new Brand;
        $brand->name = 'Test brand';
        $brand->save();
        Type::create(['name' => 'Test type']);

        $this->get(route('admin.manuals.create'))
            ->assertOk()
            ->assertSee('Test brand')
            ->assertSee('Test type');
    }

    public function test_manual_can_be_created_with_a_new_type_when_no_type_is_selected(): void
    {
        $brand = new Brand;
        $brand->name = 'Test brand';
        $brand->save();

        $response = $this->post(route('admin.manuals.store'), [
            'brand_id' => $brand->id,
            'new_type' => 'New product type',
            'name' => 'Test manual',
            'filesize' => 1024,
            'originUrl' => 'https://example.com/manual.pdf',
        ]);

        $type = Type::where('name', 'New product type')->firstOrFail();
        $manual = Manual::where('name', 'Test manual')->firstOrFail();

        $response->assertRedirect(route('admin.manuals.create'));
        $this->assertDatabaseHas('manual_type', [
            'manual_id' => $manual->id,
            'type_id' => $type->id,
        ]);
    }
}

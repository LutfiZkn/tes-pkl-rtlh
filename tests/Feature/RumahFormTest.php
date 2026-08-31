<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

describe('rumah form', function () {
    it('renders a form that posts to the store route with the expected fields', function () {
        $user = User::factory()->create([
            'username' => 'tester',
            'role' => 'Admin',
        ]);

        $response = $this->actingAs($user)->get(route('rumah.create'));

        $response->assertOk();
        $response->assertSee('action="' . route('rumah.store') . '"', false);
        $response->assertSee('method="POST"', false);
        $response->assertSee('name="nama_pemilik"', false);
        $response->assertSee('name="kelurahan_id"', false);
        $response->assertSee('name="tahun_pendataan"', false);
    });

    it('shows the rumah index page without crashing when no kecamatan filter is selected', function () {
        $user = User::factory()->create([
            'username' => 'index-tester',
            'role' => 'Admin',
        ]);

        $response = $this->actingAs($user)->get(route('rumah.index'));

        $response->assertOk();
        $response->assertSee('Filter Data Rumah');
        $response->assertSee('Semua');
    });
});

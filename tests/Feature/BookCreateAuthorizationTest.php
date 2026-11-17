<?php

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

it('redirects students from the book creation page', function () {
    $this->seed(RolePermissionSeeder::class);

    $student = User::factory()->create();
    $student->assignRole('siswa');

    $this->actingAs($student)
        ->get(route('buku.form'))
        ->assertRedirect(route('buku.index'))
        ->assertSessionHas('error', 'Anda tidak memiliki izin untuk menambah buku.');
});

it('allows admins to open the book creation page', function () {
    $this->seed(RolePermissionSeeder::class);

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin)
        ->get(route('buku.form'))
        ->assertOk()
        ->assertViewIs('buku.form');
});

it('forbids students from storing books', function () {
    $this->seed(RolePermissionSeeder::class);

    $student = User::factory()->create();
    $student->assignRole('siswa');

    $this->actingAs($student)
        ->post(route('buku.store'))
        ->assertForbidden();
});

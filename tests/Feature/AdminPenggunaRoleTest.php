<?php

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(function () {
    $this->seed(RolePermissionSeeder::class);
});

it('updates both the user role column and the Spatie role assignment', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['role' => 'admin'])->save();
    $admin->assignRole('admin');

    $user = User::factory()->create();
    $user->assignRole('siswa');

    $this->actingAs($admin)
        ->patch(route('admin.pengguna.updateRole', $user), ['role' => 'petugas'])
        ->assertRedirect();

    expect($user->fresh()->role)->toBe('petugas')
        ->and($user->fresh()->hasRole('petugas'))->toBeTrue()
        ->and($user->fresh()->hasRole('siswa'))->toBeFalse();
});

it('rejects roles not registered for the web guard', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['role' => 'admin'])->save();
    $admin->assignRole('admin');

    $user = User::factory()->create();
    $user->assignRole('siswa');

    $this->actingAs($admin)
        ->from(route('admin.pengguna'))
        ->patch(route('admin.pengguna.updateRole', $user), ['role' => 'superadmin'])
        ->assertSessionHasErrors('role')
        ->assertRedirect(route('admin.pengguna'));

    expect($user->fresh()->role)->toBe('siswa')
        ->and($user->fresh()->hasRole('siswa'))->toBeTrue();
});

it('prevents an admin from changing their own role', function () {
    $admin = User::factory()->create();
    $admin->forceFill(['role' => 'admin'])->save();
    $admin->assignRole('admin');

    $this->actingAs($admin)
        ->from(route('admin.pengguna'))
        ->patch(route('admin.pengguna.updateRole', $admin), ['role' => 'siswa'])
        ->assertRedirect(route('admin.pengguna'))
        ->assertSessionHas('error');

    expect($admin->fresh()->role)->toBe('admin')
        ->and($admin->fresh()->hasRole('admin'))->toBeTrue();
});

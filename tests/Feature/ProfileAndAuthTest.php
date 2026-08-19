<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileAndAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_profile_page(): void
    {
        $this->seed();

        $user = User::where('peran', 'Petani')->first();

        $response = $this->actingAs($user)->get(route('profile.show'));

        $response->assertStatus(200);
        $response->assertSee('Profil Saya');
        $response->assertSee($user->nama);
    }

    public function test_user_can_update_profile_info(): void
    {
        $this->seed();

        $user = User::where('peran', 'Petani')->first();

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'nama' => 'Nama Baru Petani',
            'username' => 'petani_baru',
        ]);

        $response->assertRedirect(route('profile.show'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'nama' => 'Nama Baru Petani',
            'username' => 'petani_baru',
        ]);
    }

    public function test_user_can_change_password(): void
    {
        $this->seed();

        $user = User::where('username', 'petani')->first();

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'nama' => $user->nama,
            'username' => $user->username,
            'current_password' => 'password123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect(route('profile.show'));
        $user->refresh();
        $this->assertTrue(Hash::check('newpassword123', $user->password));
    }

    public function test_user_can_logout_successfully(): void
    {
        $this->seed();

        $user = User::first();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_user_can_logout_via_get_method(): void
    {
        $this->seed();

        $user = User::first();

        $response = $this->actingAs($user)->get(route('logout'));

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}

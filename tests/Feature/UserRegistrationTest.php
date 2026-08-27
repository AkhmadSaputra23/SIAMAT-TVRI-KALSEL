<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_successfully(): void
    {
        $response = $this->postJson('/api/users', [
            'name' => 'eko',
            'email' => 'eko@localhost',
            'password' => 'rahasia',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => 'OK',
                 ]);

        $this->assertDatabaseHas('users', [
            'name' => 'eko',
            'email' => 'eko@localhost',
        ]);

        $user = User::where('email', 'eko@localhost')->first();
        $this->assertTrue(Hash::check('rahasia', $user->password));
    }

    public function test_user_cannot_register_with_duplicate_email(): void
    {
        // Pre-create a user
        User::create([
            'name' => 'Existing User',
            'email' => 'eko@localhost',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/users', [
            'name' => 'eko',
            'email' => 'eko@localhost',
            'password' => 'rahasia',
        ]);

        $response->assertStatus(400)
                 ->assertJson([
                     'error' => 'Email sudah terdaftar',
                 ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // protected $specialUser;

    // public function setUp(): void
    // {
    //     parent::setUp();

    //     // $this->specialUser = User::factory()->create([
    //     //     'name' => 'User',
    //     //     'email' => 'user@gmail.com',
    //     //     'password' => bcrypt('123456'),
    //     // ]);
    // }


    /** @test */
    public function it_registers_a_new_user()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                'token',
            ]);
    }

    /** @test */
    public function it_logs_in_a_user()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $credentials = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $credentials);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);
    }
}

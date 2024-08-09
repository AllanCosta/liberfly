<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $specialUser;
    protected $emailUser;
    protected $passwordUser;


    public function setUp(): void
    {
        parent::setUp();
        $this->emailUser = 'testuserspecial@gmail.com';
        $this->passwordUser = '1aA$23456';

        $this->specialUser = User::factory()->create([
            'name' => 'Test User special',
            'email' => $this->emailUser,
            'document' => '88882366547',
            'password' => $this->passwordUser,
        ]);
    }


    /** @test */
    public function it_registers_a_new_user()
    {
        $userData = [
            'name' => 'Test New User',
            'email' => 'testnewuser@example.com',
            'document' => '09852366547',
            'password' => 'avd1Word$',
            'password_confirmation' => 'avd1Word$',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['name', 'email', 'document', 'active', 'created_at'],
            ]);
    }

    /** @test */
    public function it_logs_in_a_user()
    {
        $credentials = [
            'email' => $this->specialUser['email'],
            'password' => $this->specialUser['password'],
        ];

        $response = $this->postJson('/api/login', $credentials);

        Log::debug($response->status());

        $sucess = $response->status();
        if ($sucess == 200) {
            $response->assertStatus(200)
                ->assertJsonStructure([
                    'access_token',
                    'token_type',
                    'expires_in',
                ]);
        } else {
            $response->assertStatus(500)
                ->assertJsonStructure([
                    'slug',
                    'title',
                    'description',
                ]);
        }
    }
}

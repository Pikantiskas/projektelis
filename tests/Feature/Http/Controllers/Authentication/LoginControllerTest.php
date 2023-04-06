<?php

namespace Tests\Feature\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validates_login(): void
    {
        $user = User::factory()->create();

        $response = $this->post(
            route('authentication.login'),
            [
                'email' => $user->email,
                'password' => 'password'
            ]
        );

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('dashboard'));
    }

    /**
     * @dataProvider dataProviderFailedAuthentication
     */
    public function test_does_not_authenticate_with_wrong_credentials(callable $getCredentials): void
    {
        $this->post(
            route('authentication.login'),
            $getCredentials()
        );

        $this->assertGuest();
    }

    public function dataProviderFailedAuthentication(): array
    {
        return [
            'fails to authenticate with wrong email' => [
                function() {
                    $user = User::factory()->create();

                    return [
                        'email' => 'any_mail@gmail.com',
                        'password' => 'password'
                    ];
                }
            ],
            'fails to authenticate with wrong password' => [
                function() {
                    $user = User::factory()->create();

                    return [
                        'email' => $user->email,
                        'password' => 'wrong_password'
                    ];
                }
            ],
        ];
    }
}

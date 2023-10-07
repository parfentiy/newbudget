<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/reguser');
=======
    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

        $response->assertStatus(200);
    }

<<<<<<< HEAD
    public function test_new_users_can_register(): void
    {
        $response = $this->post('/reguser', [
=======
    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}

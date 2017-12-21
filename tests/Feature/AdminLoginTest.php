<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLoginTest extends TestCase
{
    /**
     * Admin existance test.
     *
     * @return void
     */
    public function testAdminExistance()
    {
        $this->assertDatabaseHas('users', [
            'email' => 'admin@admin.com',
            'type'  => 'admin'
        ]);
    }

    /**
     * Credentials test.
     *
     * @return void
     */
    public function testCredentials()
    {
        $this->assertCredentials([
            'email'    => 'admin@admin.com',
            'password' => 'secret'
        ]);
    }

    /**
     * Admin login test.
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $response = $this->post('http://staff.'.ENV('APP_URL').'/login', [
            'email'    => 'admin@admin.com',
            'password' => 'secret'
        ]);

        $response->assertRedirect('http://staff.'.ENV('APP_URL').'/home');
    }
}

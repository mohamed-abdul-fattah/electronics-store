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
     * Admin login test.
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $user = factory(User::class)->make([
            'name'     => 'Software Tester',
            'type'     => 'user',
            'password' => 'secret'
        ]);

        $response = $this->actingAs($user)
            ->post('http://staff.'.ENV('APP_URL').'/login');

        $response->assertRedirect('http://staff.'.ENV('APP_URL').'/home');
    }
}

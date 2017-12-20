<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A virtual host test.
     *
     * @return void
     */
    public function testVirualHost()
    {
        $response = $this->get('http://'.ENV('APP_URL'));

        $response->assertSeeText('Electronics Store');
    }

    /**
     * A staff virtual host test.
     *
     * @return void
     */
    public function testStaffVirualHost()
    {
        $response = $this->get('http://staff.'.ENV('APP_URL'));

        $response->assertViewIs('auth.login');
    }
}

<?php

namespace Tests\Feature;

use App\User;
use App\Resource;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResourcesTest extends TestCase
{
    /**
     * A create test.
     *
     * @return void
     */
    public function testCreate()
    {
        $user     = new User();
        $response = $this->actingAs($user)->get('http://staff.'.Env('APP_URL').'/resources/create');

        $response->assertSuccessful()
            ->assertViewIs('dashboard.resources.create');
    }

    /**
     * A store test.
     *
     * @return void
     */
    public function testStore()
    {
        $user     = User::whereEmail('admin@admin.com')->first();
        $this->be($user);
        $response = $this->post('http://staff.'.Env('APP_URL').'/resources', [
            'name'    => 'Test Device',
            'desc'    => 'This is a description...'
        ]);

        $response->assertRedirect('http://staff.'.Env('APP_URL').'/home');
        $this->assertDatabaseHas('resources', [
                'user_id' => $user->id,
                'name'    => 'Test Device',
                'desc'    => 'This is a description...'
            ]);
    }

    /**
     * A edit test.
     *
     * @return void
     */
    public function testEdit()
    {
        $resource = Resource::get()->last();
        $user     = new User();
        $response = $this->actingAs($user)->get('http://staff.'.Env('APP_URL')."/resources/{$resource->id}/edit");

        $response->assertSuccessful()
            ->assertViewIs('dashboard.resources.edit');
    }

    /**
     * An update test.
     *
     * @return void
     */
    public function testUpdate()
    {
        $resource = Resource::get()->last();
        $user     = User::whereEmail('admin@admin.com')->first();
        $this->be($user);
        $response = $this->patch('http://staff.'.Env('APP_URL')."/resources/{$resource->id}", [
            'name' => 'Test Device Edited',
            'desc' => 'The same as before...'
        ]);

        $response->assertRedirect('http://staff.'.Env('APP_URL').'/home');
        $this->assertDatabaseHas('resources', [
                'user_id' => $user->id,
                'name'    => 'Test Device Edited',
                'desc'    => 'The same as before...'
            ]);
    }

    /**
     * An delete test.
     *
     * @return void
     */
    public function testDelete()
    {
        $resource = Resource::get()->last();
        $user     = User::whereEmail('admin@admin.com')->first();
        $this->be($user);
        $response = $this->delete('http://staff.'.Env('APP_URL')."/resources/{$resource->id}");

        $response->assertRedirect('http://staff.'.Env('APP_URL').'/home');
        $this->assertDatabaseMissing('resources', [
                'user_id' => $user->id,
                'name'    => 'Test Device Edited',
                'desc'    => 'The same as before...'
            ]);
    }
}

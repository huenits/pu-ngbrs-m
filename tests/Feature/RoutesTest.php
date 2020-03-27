<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    /**
     * Test home.
     *
     * @return void
     */
    public function testHomeRoute()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('Neighbors.PH');

        //$response->dumpHeaders();
        //$response->dumpSession();
        //$response->dump();
    }

    /**
     * Visit Login.
     *
     * @return void
     */
    public function testLoginRoute()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

    }

    /**
     * Visit Registration.
     *
     * @return void
     */
    public function testRegisterRoute()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);

    }

    /**
     * Visit Password Reset.
     *
     * @return void
     */
    public function testPasswordResetRoute()
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);

    }
}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;

/**
 *
 * @group login
 */
class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_error_message_on_wrong_creds()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee(config('app.name'))
                ->assertSee('Login')
                ->assertSchemeIs('https')
                ->type('email', 'paul@someemail.com')
                ->type('password', 'secret1')
                ->press('Login')
                ->assertSee('These credentials do not match our records.');
        });
    }

    public function test_a_user_can_login_with_valid_creds()
    {
        $user = factory(User::class)->create([
            'email' => 'paul@example.com',
            'name' => 'Paul',
            'password' => bcrypt('secret')
        ]);

        $this->browse(function (Browser $browser) use($user) {
            $browser->visit('/')
                ->assertSee(config('app.name'))
                ->visit('/login')
                ->assertSee('Login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/home')
                ->assertSchemeIs('https')
                ->assertSee('Paul')
                ->assertSee('You are logged in!');
        });
    }


}

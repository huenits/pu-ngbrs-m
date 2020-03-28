<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

/**
 *
 * @group register
 */
class RegistrationTest extends DuskTestCase
{

    /**
     * Required fields.
     *
     * @return void
     */
    public function test_require_name_email_and_password_to_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee(config('app.name'))
                ->assertSee('Register')
                ->assertSchemeIs('https')
                ->assertAttribute('#name', 'required', 'true')
                ->assertAttribute('#email', 'required', 'true')
                ->assertAttribute('#password', 'required', 'true')
                ->assertAttribute('#password-confirm', 'required', 'true');
        });
    }

    /**
     * Can register.
     *
     * @return void
     */
    public function test_guest_user_can_register()
    {
        // Auth::check() && Auth::logout();

        Artisan::call('migrate:fresh --seed');

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'Paolo1 Umali')
                ->type('email', 'dev@paoloumali.com')
                ->type('password', 'welcome1$')
                ->type('password_confirmation', 'welcome1$')
                ->press('Register')
                ->pause(1000)
                ->assertPathIs('/home')
                ->assertSchemeIs('https')
                ->assertSee('logged in')
                ->assertSee('Paolo1');
        });
    }
}

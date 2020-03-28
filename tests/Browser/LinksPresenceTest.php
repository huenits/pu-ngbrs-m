<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Auth;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 *
 * @group linksPresence
 */
class LinksPresenceTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_visible_links_when_guest()
    {
        Auth::logout();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee( config('app.name') )
                ->assertSourceHas( 'https://'.config('app.domain').'/login' )
                ->assertSourceHas( 'https://'.config('app.domain').'/register' )
                ;
        });
    }
}

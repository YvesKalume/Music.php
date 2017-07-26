<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminModeTest extends DuskTestCase
{
    /**
     * Asserts that 'Add Albums' is not accessible without admin privileges.
     *
     * @return void
     */
    public function testAddAlbumsNoAdmin()
    {
        $this->browse(function ($browser) {
            // $browser->loginAs(\App\User::find(1))
            $browser->visit('/')
                ->type('email', 'admin@admin.com')
                ->type('password', 'secret')
                ->press('Login')
                ->clickLink('Albums')
                ->assertDontSeeLink('Add Albums');
        });
    }

    /**
     * Asserts that 'Add Albums' is accessible with admin privileges.
     *
     * @return void
     */
    public function testAddAlbumsAdmin()
    {
        $this->browse(function ($browser) {
            // $browser->loginAs(\App\User::find(1))
            $browser->visit('/')
                ->clickLink('Enable Admin Mode')
                ->clickLink('Albums')
                ->assertSeeLink('Add Album');
        });
    }

    /**
     * Asserts that 'Upload Tracks' is not accessible without admin privileges.
     *
     * @return void
     */
    public function testUploadTracksNoAdmin()
    {
        $this->browse(function ($browser) {
            // $browser->loginAs(\App\User::find(1))
            $browser->visit('/')
                ->clickLink('Tracks')
                ->assertDontSeeLink('Upload Tracks');
        });
    }

    /**
     * Asserts that 'Upload Tracks' is accessible with admin privileges.
     *
     * @return void
     */
    public function testUploadTracksAdmin()
    {
        $this->browse(function ($browser) {
            // $browser->loginAs(\App\User::find(1))
            $browser->visit('/')
                ->clickLink('Enable Admin Mode')
                ->clickLink('Tracks')
                ->assertSeeLink('Upload Tracks');
        });
    }
}

<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SettingsTest extends DuskTestCase
{
    /**
     * Asserts that the form is accessible from the web client menu.
     *
     * @return void
     */
    public function testSettingsRoute()
    {
        $this->browse(function ($browser) {
            // $browser->loginAs(\App\User::find(1))
            $browser->visit('/')
                ->type('email', 'admin@admin.com')
                ->type('password', 'secret')
                ->press('Login')
                ->visit('/')
                ->clickLink('User Settings')
                ->assertPathIs('/settings');
        });
    }

    /**
     * Asserts that the form succeeds if all the settings remain unchanged.
     *
     * @return void
     */
    public function testUnchangedSettings()
    {
        $this->browse(function ($browser) {
            // $browser->loginAs(\App\User::find(1))
            $browser->visit('/settings')
                ->press('Update')
                ->waitForText('Submitted!', 5)
                ->assertSee('Submitted!');
        });
    }

    /**
     * Asserts that the form succeeds if all the password is modified.
     *
     * @return void
     */
     public function testChangedPassword()
     {
         $this->browse(function ($browser) {
             // $browser->loginAs(\App\User::find(1))
             $browser->visit('/settings')
                 ->type('password', 'secret')
                 ->press('Update')
                 ->waitForText('Submitted!', 5)
                 ->assertSee('Submitted!');
         });
     }
}

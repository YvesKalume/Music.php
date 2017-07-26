<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * Asserts that login fails if no data is inputted.
     *
     * @return void
     */
    public function testBlankLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->type('email', '')
                ->type('password', '')
                ->press('Login')
                ->assertPathIs('/login');
        });
    }

    /**
     * Asserts that login fails if incorrect data is inputted.
     *
     * @return void
     */
    public function testIncorrectLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->type('email', 'notadmin@notadmin.com')
                ->type('password', 'notsecret')
                ->press('Login')
                ->assertPathIs('/login');
        });
    }

    /**
     * Asserts that login succeeds if valid data is inputted.
     *
     * @return void
     */
    public function testCorrectLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->type('email', 'admin@admin.com')
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/');
        });
    }


}

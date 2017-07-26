<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AlbumCreateTest extends DuskTestCase
{
    /**
     * Asserts that a basic album upload works.
     *
     * @return void
     */
    public function testAlbumCreate()
    {
        $this->browse(function ($browser) {
            // $browser->loginAs(\App\User::find(1))
            $browser->visit('/')
                ->type('email', 'admin@admin.com')
                ->type('password', 'secret')
                ->press('Login')
                ->visit('/albums/create')
                ->attach('file', __DIR__.'/music/Enthusiast/cover.jpg')
                ->type('name', 'Enthusiast')
                ->select('artist', '1')
                ->press('Create')
                ->waitForText('Submitted!', 5)
                ->assertSee('Submitted!');
        });
    }

    /**
     * Asserts that an album upload doesn't work with null values.
     *
     * @return void
     */
    public function testAlbumCreateNull()
    {
        $this->browse(function ($browser) {
            // $browser->loginAs(\App\User::find(1))
            $browser->visit('/albums/create')
                ->press('Create')
                ->assertDontSee('Submitted!');
        });
    }
}

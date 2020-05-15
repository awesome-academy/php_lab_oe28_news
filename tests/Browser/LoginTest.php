<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    public function testLoginFailed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                ->press('Login')
                ->assertSee('The username field is required.')
                ->assertSee('The password field is required.');
        });
    }

    public function testLoginSuccessfully()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                ->type('username', 'ngoctho')
                ->type('password', '12345678')
                ->press('Login')
                ->assertPathIs('/')
                ->assertSourceHas('Logout')
                ->logout()
                ->assertGuest();
        });
    }
}

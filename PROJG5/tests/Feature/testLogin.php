<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testLogin extends TestCase
{
    /**
     * test If the url used to create a user is good
     */
    public function testLoginUrl()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * test if the header is well done
     */
    public function testHeaderLogin()
    {
        $response = $this->get('/');
        $response->assertView()->contains('Login');
    }

    /**
     * test if the content is good
     */
    public function testContent()
    {
        $response = $this->get('/');
        $response->assertView('button')->contains('Créer');
        $response->assertView()->contains('E-Mail Address:');
        $response->assertView()->contains('Password');
        $response->assertView()->in('body')->has('.form-group');
        $response->assertView()->in('body')->has('form');
    }
}

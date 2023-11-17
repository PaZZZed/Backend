<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use InteractsWithViews;

class UserTest extends TestCase {

    /**
     * test If the url used to create a user is good
     */
    public function testCreateUserUrl() {
        $response = $this->get('/newUser');

        $response->assertStatus(200);
    }

    /**
     * test if the header is well done
     */
    public function testHeader() {
        $response = $this->get('/newUser');
        $response->assertView()->contains('Creez un nouvel utilisateur');
    }

    /**
     * test if the content is good
     */
    public function testContent() {
        $response = $this->get('/newUser');
        $response->assertView('button')->contains('Créer');
        $response->assertView()->contains('Prénom:');
        $response->assertView()->contains('Nom:');
        $response->assertView()->contains('Role:');
        $response->assertView()->contains('Mot de passe:');
        $response->assertView()->in('body')->has('.container');
        $response->assertView()->in('body')->has('.form-group');

    }

}

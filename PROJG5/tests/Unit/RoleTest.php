<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;


class RoleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */



    /**public function testDB()
    {
        factory(\App\Role::class)->create([
            'role_id' => 1,
            'nom' => 'Zedzian',
            'prenom' => 'Pawel',
            'role' => 'Student',
            'mdp' => 'tonton123'
        ]);
        $this->assertDatabaseHas(
            'roles',
            [
                'role_id' => 1,
                'nom' => 'Zedzian',
                'prenom' => 'Pawel',
                'role' => 'Student',
                'mdp' => 'tonton123'
            ]
        );
    }

    public function testDBhasNot()
    {
        $this->assertDatabaseMissing('roles', [
            'role_id' => 1,
            'nom' => 'Zedzian',
            'prenom' => 'Pawel',
            'role' => 'Student',
            'mdp' => 'tonton123'
        ]);
    }

    public function testDBDelete()
    {
        $role = factory(\App\Role::class)->create([
            'role_id' => 1,
            'nom' => 'Zedzian',
            'prenom' => 'Pawel',
            'role' => 'Student',
            'mdp' => 'tonton123'
        ]);
        $role->delete();
        $this->assertDeleted('roles', [
            'role_id' => 1,
            'nom' => 'Zedzian',
            'prenom' => 'Pawel',
            'role' => 'Student',
            'mdp' => 'tonton123'
        ]);
    }
    public function testDBSoftDelete()
    {
        $ue = factory(\App\Role::class)->create([
            'role_id' => 1,
            'nom' => 'Zedzian',
            'prenom' => 'Pawel',
            'role' => 'Student',
            'mdp' => 'tonton123'
        ]);
        $this->assertSoftDeleted('roles', [
            'role_id' => 1,
            'nom' => 'Zedzian',
            'prenom' => 'Pawel',
            'role' => 'Student',
            'mdp' => 'tonton123'
        ]);
    }*/
}

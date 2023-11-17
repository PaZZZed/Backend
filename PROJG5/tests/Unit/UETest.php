<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use InteractsWithViews;

class UETest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /**public function testExample()
    {
        //$this->assertTrue(true);
    }*/

    public function testDB()
    {
        factory(\App\UE::class)->create([
            'UE'=>'PRJG6',
            'ECTS'=>5,
            'heures'=>24
        ]);
        $this->assertDatabaseHas('u_e_s',
            ['UE'=>'PRJG6',
            'ECTS'=>5,
            'heures'=>24]
        );
    }

    public function testDBhasNot()
    {
        $this->assertDatabaseMissing('u_e_s', [
            'UE'=>'PRJG6',
            'ECTS'=>5,
            'heures'=>24
        ]);
    }

    /**public function testDBhasNoDoublePrimaryKey()
    {
        $ue1= factory(\App\UE::class)->create([
            'UE'=>'PRJG6',
            'ECTS'=>5,
            'heures'=>24
        ]);
        $ue2= factory(\App\UE::class)->create([
            'UE'=>'PRJG6',
            'ECTS'=>3,
            'heures'=>2
        ]);

        $this->assertDatabaseMissing('u_e_s', [
            'UE'=>'PRJG6',
            'ECTS'=>3,
            'heures'=>2
        ]);

        $this->assertDatabaseHas('u_e_s',
            ['UE'=>'PRJG6',
                'ECTS'=>5,
                'heures'=>24]
        );
    }*/

    /**public function testDBhasNoNegativeValues()
    {
        $ue= factory(\App\UE::class)->create([
            'UE'=>'PRJG6',
            'ECTS'=>-5,
            'heures'=>-24
            ]);
        $this->assertDatabaseMissing('u_e_s', [
            'UE'=>'PRJG6',
            'ECTS'=>-5,
            'heures'=>-24
        ]);
    }*/

    public function testDBDelete()
    {
       $ue= factory(\App\UE::class)->create([
            'UE'=>'PRJG6',
            'ECTS'=>5,
            'heures'=>24
        ]);
        $ue->delete();
        $this->assertDeleted('u_e_s',[
            'UE'=>'PRJG6',
            'ECTS'=>5,
            'heures'=>24
        ]);
    }

    public function testDBSoftDelete()
    {
       $ue= factory(\App\UE::class)->create([
            'UE'=>'PRJG6',
            'ECTS'=>5,
            'heures'=>24
        ]);
        $this->assertSoftDeleted('u_e_s',[
            'UE'=>'PRJG6',
            'ECTS'=>5,
            'heures'=>24
        ]);
    }

    /**
     * test the route and status of UE
     */
    public function testUEUrl() {
        $response = $this->get('/ues');
        $response->assertStatus(200);
    }

    /**
     * test the component of the UE view
     */
    public function testContent() {
        $response = $this->get('/ues');
        $response->assertView()->contains('h1');
        $response->assertView()->contains("Liste des UES");
        $response->assertView()->contains("form");
        $response->assertView()->contains("input");
        $response->assertView()->contains("submit");
        $response->assertView('button')->contains('Ajouter');
        $response->assertView()->contains('table');
        $response->assertView()->contains('th');
        $response->assertView()->contains('tr');
    }
}

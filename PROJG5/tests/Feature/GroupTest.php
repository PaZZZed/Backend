<?php

namespace Tests\Feature;

use App\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class GroupTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testGetDB()
    {
        factory(\App\Group::class)->create([
            'group'=>'A111',
            'bloc'=>1]);
        $this->assertDatabaseHas('Group',
            ['group'=>'A111', 'bloc'=>1]
        );
    }

   public function testDbInsert()
    {
        $group = factory(\App\Group::class)->create([
            'group'=>'d115',
            'bloc'=>4
        ]);
        $group->save();
        $this->assertDatabaseHas('Group',
            ['group'=>$group->group, 'bloc'=>$group->bloc] );
    }

    public function testDBHasNot()
    {
        $this->assertDatabaseMissing('group', [
            'group'=>'A112',
            'bloc'=>1
        ]);
    }

    public function testDBDelete()
    {
        factory(\App\Group::class)->create([
            'group'=>'d111',
            'bloc'=>4
        ]);
        $this->assertSoftDeleted('group',[
            'group'=>'d111',
            'bloc'=>4
        ]);
    }
}

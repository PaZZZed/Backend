<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class prerequisTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetDB()
    {
        factory(\App\Prerequis::class)->create([
            'ue_id'=>'ETE6',
            'prerequis'=>'SYS2']);
        $this->assertDatabaseHas('Prerequis',
            ['ue_id'=>'ETE6', 'prerequis'=>'SYS2']
        );
    }

    public function testDBHasNot()
    {
        $this->assertDatabaseMissing('prerequis', [
            'ue_id'=>'SYSG5',
            'prerequis'=>'SYS2'
        ]);
    }

    public function testDBDelete()
    {
        factory(\App\Prerequis::class)->create([
            'ue_id'=>'SYSG5',
            'prerequis'=>'SYS2'
        ]);
        $this->assertSoftDeleted('prerequis',[
            'ue_id'=>'SYSG5',
            'prerequis'=>'SYS2'
        ]);
    }

}

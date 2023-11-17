<?php

namespace Tests\Feature;

use App\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic test seeing if a student is save in the database
     */
    public function testDatabase(){
        $student = new Student([
            'numbers' => 43729,
            'first_name' => 'Chadi',
            'last_name' => 'Aydouni'
        ]);
        $student->save();
        $this->assertDatabaseHas('student', ['numbers'=>$student->numbers]);
    }

    /**
     * A basic test seeing if a student is save in the database and if we can delete it
     */
    public function testDatabaseDeleted(){
        $student = new Student([
            'numbers' => 43729,
            'first_name' => 'Chadi',
            'last_name' => 'Aydouni'
        ]);
        $student->save();
        $this->assertDatabaseHas('student', ['numbers'=>$student->numbers]);
        $student->delete();
        $this->assertDatabaseMissing('student', ['numbers'=>$student->numbers]);
    }

    /**
     * A basic test seeing if a student is save in the database and if we can modify it
     */
    public function testDatabaseModified(){
        $student = new Student([
            'numbers' => 43729,
            'first_name' => 'Chadi',
            'last_name' => 'Aydouni'
        ]);
        $student->save();
        $this->assertDatabaseHas('student', ['numbers'=>$student->numbers]);
        $student->update(['first_name' => 'Nicolas']);
        $this->assertDatabaseHas('student', ['numbers'=>$student->numbers, 'first_name' => $student->first_name]);
    }

}

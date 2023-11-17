<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ImportTest extends TestCase{
    
    /**
     * This method check if the data on the json file is good.
     */
    public function testDataOk(){
        $file = __DIR__.'/testStudent.json';
        $data = file_get_contents($file);
        $json = json_decode($data, true);
        $student = $json['students'];
        $this->assertTrue($student[0]['number'] == 12345);
        $this->assertTrue($student[0]['first_name'] == "Bob");
        $this->assertTrue($student[0]['last_name'] == "SquarePants");
    }

    /**
     * This method check if the file is a json file.
     */
    public function testIsJsonFile(){
        $file = __DIR__.'/testStudent.json';
        $data = file_get_contents($file);
        $json = json_decode($data, true);
        $this->assertTrue(json_last_error() === JSON_ERROR_NONE);
    }
}
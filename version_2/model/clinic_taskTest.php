<?php

/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 12/9/15
 * Time: 1:34 PM
 */

require_once 'clinic_task.php';

class clinicTaskTest extends PHPUnit_Framework_TestCase
{
    public function setUp(){ }
    public function tearDown(){ }

    function test_add_task(){
        $obj = new clinic_task();
        $this->assertEquals(true,$obj->add_clinic_task('Vaccination','Vacc',1,17,'2015-12-09',
            '12:00:00',2));
    }
}

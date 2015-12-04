<?php

/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/25/15
 * Time: 4:30 PM
 */
include_once 'clinic.php';

class clinicTest extends PHPUnit_Framework_TestCase
{

    public function testGetClinics(){
        $clinic = new clinic();
        $this->assertEquals(true, $clinic->get_clinics());
        return $clinic;
    }

    public function testAdd($adb){

    }

}

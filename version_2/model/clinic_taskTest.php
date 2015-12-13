<?php

/**
 * This class contains test for the clinic_task class
 * It contains relevant tests necessary for
 *
 *
 * PHP version 5.6
 *
 * @category   Model
 * @author     Kenneth Mintah Mensah <kenneth.mensah@ashesi.edu.gh>
 * @author     Joshua Atsu Aherdemla <joshua.aherdemla@ashesi.edu.gh>
 * @author     Norbert Sackey <norbert.sackey@ashesi.edu.gh>
 * @author     Edwina Baddoo <edwina.baddoo@ashesi.edu.gh>
 * @version    SVN: 2.0.0
 */

require_once 'clinic_task.php';

class clinicTaskTest extends PHPUnit_Framework_TestCase
{
    public function setUp(){ }
    public function tearDown(){ }

    /**
     * test for the adding a clinic task
     */
    function test_add_task(){
        $obj = new Clinic_Task();
        $this->assertEquals(true,$obj->addClinicTask('Vaccination','Vacc',1,17,'2015-12-09',
            '12:00:00',2));
    }

    /**
     * test for viewing all assigned tasks in the database
     */
    function test_get_all_tasks(){
        $obj = new Clinic_Task();
        $this->assertEquals(true, $obj->get_all_tasks());
    }


    /**
     * test for viewing all tasks assigned to a
     * nurse
     */
    function test_get_all_nurse_tasks(){
        $obj = new Clinic_Task();
        $this->assertEquals(true, $obj->getAllNurseTasks(1));
    }


    /**
     * test for viewing all tasks assigned in a
     * clinic
     */
    function test_get_all_clinic_tasks(){
        $obj = new Clinic_Task();
        $this->assertEquals(true, $obj->getAllClinicTasks(2));
    }
}

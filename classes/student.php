<?php
/**
 * Created by PhpStorm.
 * User: mandy
 * Date: 2/13/2019
 * Time: 10:11 AM
 */

class Student
{
    private $_sid;
    private $_last;
    private $_first;
    private $_birthdate;
    private $_gpa;
    private $_advisor;

    function __construct($sid, $last, $first, $birthdate, $gpa, $advisor)
    {
        $this->_sid=$sid;
        $this->_last=$last;
        $this->_first=$first;
        $this->_birthdate=$birthdate;
        $this->_gpa=$gpa;
        $this->_advisor=$advisor;
    }

}
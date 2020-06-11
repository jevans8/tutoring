<?php

/**
 * Class Tutor
 * Contains the methods for all tutor objects
 * @author Julia Evans, Elric Barkey, Zach Frehner
 * @version 1.0
 */
class Tutor extends Student
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////// constructor
    /**
     * Tutor constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTutorStatus(true);
    }

}
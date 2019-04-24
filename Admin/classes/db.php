<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 11/28/2018
 * Time: 12:47 PM
 */

class Db
{
    public $con;

    public function __construct() {
        $localhost = 'localhost';
        $name = 'root';
        $pass = '';
        $dbName = 'sheba';
        $this->con = mysqli_connect($localhost, $name, $pass, $dbName);
        if (!$this->con) {
            echo 'This is Problem of Database and Server' . mysqli_error($this->con);
        }
    }
    public function getAllfile (){

    }
}
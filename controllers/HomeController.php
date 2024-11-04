<?php
class HomeController
{
    public $modelHome;
    public function __construct() {
        $this->modelHome = new Home();
    }

    public function index() {
        require_once 'views/home.php';
    }
}
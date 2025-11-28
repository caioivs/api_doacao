<?php
namespace controller;
use template\IdeiaTemp;

class Home {
    private $template;

    public function __construct() {
        $this->template = new IdeiaTemp();
    }

    public function index() {
        $this->template->layout("public/home.php");
    }
}
<?php

namespace app\controller;

class NotfoundController
{

    public function __construct() {}
    public function index()
    {
        require_once __DIR__ . '/../view/404.php';
    }
    public function default()
    {
        $this->index();
    }
}

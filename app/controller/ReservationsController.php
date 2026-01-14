<?php

namespace app\controller;

use app\model\Client;

class ReservationsController
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }
    public function default()
    {
        require_once __DIR__ . '/../view/favorites.php';
    }
    public function index()
    {
        require_once __DIR__ . '/../view/favorites.php';
    }
}

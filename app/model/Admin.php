<?php

namespace app\model;

use app\model\Utilisateur;

class Admin extends Utilisateur

{
    public function __construct()
    {
        parent::__construct();
    }
    public function __toString(): string
    {
        return parent::__toString();
    }
}

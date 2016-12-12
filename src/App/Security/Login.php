<?php

namespace App\Security;

use App\Services\UserManager;

class Login
{
    /**
     * @var UserManager 
     */
    private $userManager;

    /**
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function redirectIfNotLoggedIn()
    {
        if (!$this->userManager->userLoggedIn()) {
            header('Location: ./login');
            die();
        }
    }

    public function redirectIfLoggedIn()
    {
        if ($this->userManager->userLoggedIn()) {
            header('Location: ./');
            die();
        }
    }

    public function logout()
    {
        $this->userManager->logout();
        header('Location: ./');
        die();
    }
}

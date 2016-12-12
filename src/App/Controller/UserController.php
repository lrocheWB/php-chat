<?php

namespace App\Controller;

use App\Security\Login;
use App\Services\UserManager;
use App\View\View;
use App\Validation\RegisterFormValidator;
use Respect\Validation\Validator;

class UserController
{
    /**
     * @var Login
     */
    private $login;

    /**
     * @var View
     */
    private $view;

    /**
     * @var UserManager
     */
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->login = new Login($this->userManager);
        $this->view = new View();
    }

    public function indexAction()
    {
        $this->login->redirectIfNotLoggedIn();

        return $this->view->render('chat');
    }

    public function loginAction()
    {
        $this->login->redirectIfLoggedIn();

        return $this->view->render('login');
    }

    public function registerAction()
    {
        $this->login->redirectIfLoggedIn();

        return $this->view->render('register');
    }

    public function logoutAction()
    {
        $this->login->logout();
    }

    public function submitFormAction()
    {
        if (isset($_POST['uname']) && !empty($_POST['uname'])
            && isset($_POST['passwd']) && !empty($_POST['passwd'])
        ) {
            if (!$this->userManager->login($_POST['uname'], $_POST['passwd'])) {
                $_SESSION['login_errors'] = "Error occured. Try again later !";
            } else {
                $_SESSION["token"] = md5(uniqid(mt_rand(), true));
                header('Location: ./');
                die;
            }
        }

        header('Location: ./login');
        die;
    }

    public function submitRegisterAction()
    {
        $form = new RegisterFormValidator(new Validator());

        if ($form->isValid()) {
            if ($this->userManager->register($_POST['uname'], $_POST['passwd'])) {
                $_SESSION['login_errors'] = [];
                header('Location: ./login?register=1');
                die;
            }
        }

        header('Location: ./register');
        die;
    }
}

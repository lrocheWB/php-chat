<?php

namespace App\Validation;

use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;

class RegisterFormValidator
{
    /**
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function isValid()
    {
        $errors = [];

        $usernameValidator = Validator::alnum()->noWhitespace()->length(1, 255);
        $passwordValidator = Validator::regex("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/");

        try {
            $usernameValidator->assert($_POST['uname']);
        } catch(NestedValidationException $exception) {
            $errors['uname'] = $exception->getFullMessage();
        }

        if(!$passwordValidator->validate($_POST['passwd'])){
            $errors['passwd'] = 'The Password: <br/>'
                . '- must be at least 8 characters<br/>'
                . '- must contain at least 1 capital letter<br/>'
                . '- must contain at least 1 digit';
        }

        if (!empty($errors)){
            $_SESSION['register_errors'] = $errors;
            return false;
        }

        return true;
    }
}

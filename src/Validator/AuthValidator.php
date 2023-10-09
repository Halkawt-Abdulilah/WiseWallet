<?php

namespace Wisewallet\Validator;

use Wisewallet\Model\SignupModel;
use Wisewallet\Repository\AuthRepository;

class AuthValidator
{
    public function validateLoginInput($inputs)
    {
        $errors = [];

        if (empty($inputs->getEmail())) {
            $errors['email'] = "Email address is required";
        } elseif (!filter_var($inputs->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email address format";
        }

        if (empty($inputs->getPassword())) {
            $errors['password'] = "Password is required";
        } elseif (strlen($inputs->getPassword()) < 8) {
            $errors['password'] = "Password must be at least 8 characters long";
        }

        return $errors;
    }

    public function validateSignupInput(SignupModel $inputs)
    {
        $authRepository = new AuthRepository();
        $errors = [];

        if (empty($inputs->getFirstName())) {
            $errors['first-name'] = "First Name is required";
        }
        if (empty($inputs->getLastName())) {
            $errors['last-name'] = "Last Name is required";
        }
        if (empty($inputs->getUsername())) {
            $errors['username'] = "Username is required";
        }
        if ($authRepository->checkUsernameExistense($inputs->getUsername())) {
            $errors['username'] = "Username '" . $inputs->getUsername() . "' already exists";
        }

        if (empty($inputs->getEmail())) {
            $errors['email'] = "Email address is required";
        } elseif (!filter_var($inputs->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email address format";
        }

        if (empty($inputs->getPassword())) {
            $errors['password'] = "Password is required";
        } elseif (strlen($inputs->getPassword()) < 8) {
            $errors['password'] = "Password must be at least 8 characters long";
        }

        if (empty($inputs->getConfirmPassword())) {
            $errors['repeat-password'] = "Please confirm your password";
        } elseif ($inputs->getPassword() !== $inputs->getConfirmPassword()) {
            $errors['repeat-password'] = "Passwords do not match";
        }

        return $errors;
    }
}

?>
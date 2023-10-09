<?php

namespace Wisewallet\Controller;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Wisewallet\Model\LoginModel;
use Wisewallet\Model\SignupModel;
use Wisewallet\Validator\AuthValidator;
use Wisewallet\Repository\AuthRepository;


class AuthController
{
    public function showLogin()
    {
        HomeController::display("login", "auth");
    }
    public function showSignup()
    {
        HomeController::display("signup", "auth");
    }

    public function login()
    {
        $authValidator = new AuthValidator();
        $authRepository = new AuthRepository();

        $email = $this->filterInput($_POST['login-email']) ?? '';
        $password = $this->filterInput($_POST['login-password']) ?? '';
        $loginValidate = new LoginModel($email, $password);
        $loginModel = new LoginModel($email, md5($password));

        $loginInputErrors = $authValidator->validateLoginInput($loginValidate);

        if (!empty($loginInputErrors)) {
            echo json_encode($loginInputErrors);
        } else {
            if ($authRepository->checkAccountCredentials($loginModel)) {

                if ($authRepository->checkAccessLevel($loginModel)) {
                    $info = array(
                        "email" => $email,
                        "access" => "Shadmin"
                    );
                } else {
                    $info = array(
                        "email" => $email,
                        "access" => "User"
                    );
                }

                // var_dump($info);
                // exit;

                $jwt = JWT::encode($info, "Shakey", "HS256");
                setcookie("jwt", $jwt, time() + 3600);

                echo json_encode([]);
            }
        }

    }


    public function signup()
    {
        $authValidator = new AuthValidator();
        $authRepository = new AuthRepository();

        $firstName = $this->filterInput($_POST['signup-first-name']) ?? '';
        $lastName = $this->filterInput($_POST['signup-last-name']) ?? '';
        $username = $this->filterInput($_POST['signup-username']) ?? '';
        $email = $this->filterInput($_POST['signup-email']) ?? '';
        $password = $this->filterInput($_POST['signup-password']) ?? '';
        $confirm_password = $this->filterInput($_POST['signup-repeat-password']) ?? '';

        $inputs = ['first-name' => $firstName, 'last-name' => $lastName, 'username' => $username, 'email' => $email, 'password' => $password, 'repeat-password' => $confirm_password];
        $signupModel = new SignupModel($firstName, $lastName, $username, $email, $password, $confirm_password);

        $signupInputErrors = $authValidator->validateSignupInput($signupModel);
        if (!empty($signupInputErrors)) {
            echo json_encode($signupInputErrors);
        } else {
            $authRepository->createUser($signupModel);
            echo json_encode([]);
        }

    }

    private static function filterInput($input)
    {
        return filter_var($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

}

?>
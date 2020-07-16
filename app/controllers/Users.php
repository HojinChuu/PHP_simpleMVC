<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            if(empty($data['email'])) {
                $data['email_err'] = "이메일을 입력해주세요";
            } else {
                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "이미 존재하는 이메일입니다";
                }
            }

            if(empty($data['name'])) {
                $data['name_err'] = "이름을 입력해주세요";
            }

            if(empty($data['password'])) {
                $data['password_err'] = "비밀번호를 입력해주세요";
            } else if(strlen($data['password']) < 6) {
                $data['password_err'] = "비밀번호는 6자 이상 작성해주세요";
            }

            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "비밀번호 확인란을 입력해주세요";
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = "비밀번호를 동일하게 입력해주세요";
                }
            }

            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
                if($this->userModel->register($data)) {
                    flash('register_success', 'You are registerd and can login');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }

            } else {
                $this->view('users/register', $data);
            }

        } else {
            
            // init
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            if(empty($data['email'])) {
                $data['email_err'] = "이메일을 입력해주세요";
            }

            if(empty($data['password'])) {
                $data['password_err'] = "비밀번호를 입력해주세요";
            }

            if($this->userModel->findUserByEmail($data['email'])) {

            } else {
                $data['email_err'] = "존재하지않은 이메일입니다";
            }

            if(empty($data['email_err']) && empty($data['password_err'])) {
                
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = "패스워드가 틀렸습니다";
                    $this->view('users/login', $data);
                }

            } else {
                $this->view('users/login', $data);
            }

        } else {
            // init
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;

        redirect('pages/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();

        redirect('users/login');
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']) ? true : false;
    }
}
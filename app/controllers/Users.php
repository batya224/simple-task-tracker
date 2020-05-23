<?php

/**
 * User class
 */
class Users extends Controller
{
    public function __construct()
    {
        $this->model = $this->model('User');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'password_error' => '',
                'username_error' => '',
            ];

            if (empty($data['username'])) {
                $data['username_error'] = 'Please enter username';
            } else {
                $found = $this->model->get_user('username', $data['username']);
                if (!$found) {
                    $data['username_error'] = 'No user was found, try again.';
                }
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            }


            //Make sure errors are not empty
            if (empty($data['username_error']) && empty($data['password_error'])) {
                $logged_in = $this->model->login($data['username'], $data['password']);
                if ($logged_in) {
                    $_SESSION['user_id'] = $logged_in->id;
                    $_SESSION['username'] = $logged_in->username;
                    set_alert_message('register_success', 'User was successfully logged in', 'alert-success');

                    redirect('users/profile');
                } else {
                    $data['password_error'] = 'Incorrect password.';
                }


            }

        } else {

            $data = [
                'username' => '',
                'password' => '',
                'username_error' => '',
                'password_error' => '',
            ];
        }


        $this->view('users/login', $data);
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'confrim_password' => trim($_POST['confrim_password']),
                'username_error' => '',
                'password_error' => '',
                'confrim_password_error' => ''
            ];

            if (empty($data['username'])) {
                $data['username_error'] = 'Please enter username';
            } else {
                $found = $this->model->get_user('username', $data['username']);

                if ($found) {
                    $data['username_error'] = 'Username is already taken';
                }
            }

            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter username';
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            }

            if (empty($data['confrim_password'])) {
                $data['confrim_password_error'] = 'Please confirm password';
            } else {
                if ($data['password'] !== $data['confrim_password']) {
                    $data['confrim_password_error'] = 'Passwords do not match';
                }
            }

            //Make sure errors are not empty
            if (empty($data['username_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confrim_password_error'])) {

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                $result = $this->model->register($data);

                if ($result) {
                    set_alert_message('register_success', 'User was successfully registered', 'alert-success');
                    redirect('users/login');
                }
                die('Something went wrong');
            }

        } else {
            $data = [
                'name' => '',
                'username' => '',
                'password' => '',
                'confrim_password' => '',
                'name_error' => '',
                'username_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];
        }


        $this->view('users/register', $data);
    }

    public function logout()
    {
        session_destroy();
        redirect('users/login');
    }

    public function profile()
    {
        if (!is_logged_in()) {
            redirect('users/login');
        }
        $this->view('users/profile');
    }


}

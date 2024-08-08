<?php
require_once "./mvc/models/Webservice.php";

class Login {
    public function Show() {
        require_once "./mvc/views/login.php";
    }

    public function Authenticate() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $webservice = new Webservice();
        $response = $webservice->callLoginService($username, $password);

        if ($response['success']) {
            session_start();
            $_SESSION['user'] = $response['user'];
            header('Location: /home');
        } else {
            $data['error'] = 'Invalid username or password';
            require_once "./mvc/views/login.php";
        }
    }

    public function Logout() {
        session_start();
        session_destroy();
        header('Location: /login');
    }
}
?>

<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';

class AuthController {
    private $view;
    private $model;
    
    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function verFormIngresar() {
        $this->view->verFormIngresar();
    }

    public function validarUsuario() {
        // toma los datos del form
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            // toma los datos del form
            $email = $_POST['email'];
            $password = $_POST['password'];

            // busco el usuario por email
            $user = $this->model->getUserByEmail($email);

            // verifico que el usuario existe y que las contraseñas son iguales
            if ($user && password_verify($password, $user->password)) {

                // inicio una session para este usuario
                session_start();
                $_SESSION['USER_ID'] = $user->id; 
                $_SESSION['USER_EMAIL'] = $user->email;
                $_SESSION['IS_LOGGED'] = true; // guardo que esta el usuario logueado para home pueda verificar si mostrarse o no

                header("Location: " . BASE_URL); // entra y lo lleva al home
            } else {
                // si los datos son incorrectos muestro el form con un error
                $this->view->verFormIngresar("Usuario o contraseña no existen");
            } 
        }
    }

    public function salir() {
        session_start(); // CONSULTA LA SESION ACTUAL
        session_destroy(); // CIERRA LA SESION ACTUAL
        header("Location: " . BASE_URL); // REDIRECCIONA AL LOGIN
    } 
}

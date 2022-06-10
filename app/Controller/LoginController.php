<?php

    class LoginController
    {
        public function index()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('login.html');
                $parameters['error'] = $_SESSION['msg_error'] ?? null;
            $conteudo = $template->render();
            echo $conteudo;
        }

        public function Check()
        {
            try{
                $user = new User;
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['senha']);
                $user->validateLogin();

                header('Location: ?class=Home');
            }catch(\Exception $e){
                $_SESSION['msg_error'] = array('msg' => $e->getMessage(), 'count'=>0);
                
                header('Location: ?class=Login');
            }
        }

    }
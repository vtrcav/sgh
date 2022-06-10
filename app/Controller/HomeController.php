<?php

    class HomeController
    {
        public function index()
        {
            try{   
                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('home.html');

                $parametros = array();
                $parametros['nome'] = 'Vitor';

                $conteudo = $template->render($parametros);

                
                echo $conteudo;

                
/*                 var_dump($todosUsuarios);
 */            }catch (Exception $e){
                echo $e->getMessage();
            }
            //echo 'oi s';
            
        }
        /* {
            $ac = $_SESSION['usr']['permitions'];
            $permitions_array = explode(' ', $ac);
            $permitions_array;

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');
                $parameters['name_user'] = $_SESSION['usr']['name_user'];

            $conteudo = $template->render($parameters);
                
                
            echo $conteudo;

           echo 'Olá, ' . $_SESSION['usr'] . ' seu id é ' . $_SESSION['uid'] . ' e seu nivel é ' . $_SESSION['niv'] . '<br> <a href="?class=Logout">Logout</a>';
 
            
        } */

    
    }
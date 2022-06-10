<?php

    class ListaUsuariosController
    {
        public function index()
        {
            try{
                $todosUsuarios = ConsultaDatabase::Usuarios();

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('usuarios.html');

                $parametros = array();
                $parametros['IdUsuario'] = $todosUsuarios;

                $conteudo = $template->render($parametros);
                echo $conteudo;

                
/*                 var_dump($todosUsuarios);
 */            }catch (Exception $e){
                echo $e->getMessage();
            }
            //echo 'oi s';
            
        }
    }
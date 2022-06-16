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

        public function cadastrar()
        {
            try{

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('cadastrousuario.html');

                $conteudo = $template->render();
                echo $conteudo;

            }catch (Exception $e){
                echo $e->getMessage();
            }

            
        }
        public function editar($paramId)
        {
            $paramId = $_GET['id'];
            
                                           
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('editarusuario.html');

            $usuario = User::editar($paramId);

            $parametros = array();
            $parametros['Nome'] = $usuario->Nome;
            $parametros['Sobrenome'] = $usuario->Sobrenome;
            $parametros['Email'] = $usuario->Email;
            $parametros['NivelUsuario'] = $usuario->NivelUsuario;
            $parametros['IdUsuario'] = $usuario->IdUsuario;



            $conteudo = $template->render($parametros);
            echo $conteudo;

                
        }

        public function inserir()
        {
            try{
                User::inserir($_POST);

                echo '<script>alert("Usuário '.$_POST['nome'].' cadastrado!")</script>';
                echo '<script>location.href="?class=ListaUsuarios"</script>';

            }catch (Exception $e){
                echo '<script>alert("'.$e->getMessage().'")</script>';
                header ('?class=ListaUsuarios&method=cadastrar');
            }
        }

        public function atualizar()
		{
			try {
				User::atualizar($_POST);

				/* echo '<script>location.href="?class=ListaUsuarios"</script>'; */
                echo '<div id="alerta" class="alert alert-success" role="alert">Usuário atualizado!</div>';

			} catch (Exception $e) {

				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="?class=ListaUsuarios&method=atualizar&id='.$_POST['id'].'"</script>';

			}
		}

        public function remover($id)
        {
            $id = $_GET['id'];
            
            try{
                User::remover($id);

                echo '<script>alert("Usuário removido!")</script>';
                echo '<script>location.href="?class=ListaUsuarios"</script>';
            }catch (Exception $e){
                echo '<script>alert("'.$e->getMessage().'")</script>';
                header ('?class=ListaUsuarios&method=cadastrar');
            }
        }

    }
<?php

    class ListaPacientesController
    {
        public function index()
        {
            try{
                

                $todosUsuarios = Pacientes::listar();

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('pacientes.html');

                $parametros = array();
                $parametros['idPaciente'] = $todosUsuarios;

                $conteudo = $template->render($parametros);
                echo $conteudo;

                
            }catch (Exception $e){
                echo $e->getMessage();
            }
            //echo 'oi s';
            
        }

        public function cadastrar()
        {
            try{
                
                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('cadastrarpaciente.html');

                
                

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
            $template = $twig->load('editarpaciente.html');

            $paciente = Pacientes::editar($paramId);

            $parametros = array();
            $parametros['idPaciente'] = $paciente->idPaciente;
            $parametros['prontuario'] = $paciente->prontuario;
            $parametros['nomeCompleto'] = $paciente->nomeCompleto;
            $parametros['nomeMae'] = $paciente->nomeMae;
            $parametros['cpf'] = $paciente->cpf;
            $parametros['cns'] = $paciente->cns;
            $parametros['dnasc'] = $paciente->dnasc;
            $parametros['dtadmissao'] = $paciente->dtadmissao;
            $parametros['telefone'] = $paciente->telefone;
            $parametros['cep'] = $paciente->cep;
            $parametros['endereco'] = $paciente->endereco;
            $parametros['bairro'] = $paciente->bairro;
            $parametros['cidade'] = $paciente->cidade;
            $parametros['uf'] = $paciente->uf;


            $conteudo = $template->render($parametros);
            echo $conteudo;

                
        }
        
        public function atualizar()
		{
			try {
				Pacientes::atualizar($_POST);

				/* echo '<script>location.href="?class=ListaPacientes"</script>'; */
                echo '<div id="alerta" class="alert alert-success" role="alert">
                Paciente <b></b> atualizado
                </div>';

			} catch (Exception $e) {

				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="?class=ListaPacientes&method=update&id='.$_POST['id'].'"</script>';

			}
		}

        public function inserir()
        {
            try{
                Pacientes::inserir($_POST);

                echo '<script>alert("Paciente '.$_POST['nomeCompleto'].' foi cadastrado!")</script>';
                echo '<script>location.href="?class=ListaPacientes"</script>';

            }catch (Exception $e){
                echo '<script>alert("'.$e->getMessage().'")</script>';
                header ('?class=ListaPacientes&method=cadastrar');
            }
        }

        public function remover($id)
        {
            $id = $_GET['id'];
            
            try{
                Pacientes::remover($id);

                echo '<script>alert("Paciente '.$_POST['nomeCompleto'].' removido!")</script>';
                echo '<script>location.href="?class=ListaPacientes"</script>';
            }catch (Exception $e){
                echo '<script>alert("'.$e->getMessage().'")</script>';
                header ('?class=ListaPacientes&method=cadastrar');
            }
        }


    }
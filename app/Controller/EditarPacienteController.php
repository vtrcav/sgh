<?php

    class EditarPacienteController
    {
        public function index()
        {
            try{
                $todosUsuarios = ConsultaDatabase::Pacientes();

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('editarpaciente.html');

                $parametros = array();
                $parametros['idPaciente'] = $todosUsuarios;

                $conteudo = $template->render($parametros);
                echo $conteudo;

                
/*                 var_dump($todosUsuarios);
 */            }catch (Exception $e){
                echo $e->getMessage();
            }
            //echo 'oi s';
            
        }

        public static function selecionaporid($params)
        {
            $con = Connection::GetConn();

            $sql = "SELECT * FROM pacientes WHERE idPaciente = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $params, PDO::PARAM_INT);
            $sql->execute();

            $resultado = array();

            if(!$resultado){
                throw new Exception("Não foi encontrado nenhum resultado");
            }

            return $resultado;
        }
    }
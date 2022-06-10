<?php

    class ListaInsumoseMedicamentosController
    {
        public function index()
        {
            try{
                $todoMaterial = ConsultaDatabase::InsumoseMedicamentos();

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('insumos_medicamentos.html');

                $parametros = array();
                $parametros['idProduto'] = $todoMaterial;

                $conteudo = $template->render($parametros);
                echo $conteudo;

                
/*                 var_dump($todosUsuarios);
 */            }catch (Exception $e){
                echo $e->getMessage();
            }
            //echo 'oi s';
            
        }
    }
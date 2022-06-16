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

                
            
            }catch (Exception $e){
                echo $e->getMessage();
            }
            
            
        }

        public function cadastrar()
        {
            try{
                $todoMaterial = ConsultaDatabase::InsumoseMedicamentos();

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('cadastroimed.html');

                $parametros = array();
                $parametros['idProduto'] = $todoMaterial;

                $conteudo = $template->render($parametros);
                echo $conteudo;

                
            
            }catch (Exception $e){
                echo $e->getMessage();
            }
            
            
        }
    }
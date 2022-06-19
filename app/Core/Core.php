<?php

    class Core
    {
        private $controller;
        private $method = 'index';
        private $params = array();
        private $user;
        private $error;
        private $request;


        public function __construct()
   	    {
        $this->user = $_SESSION['usr'] ?? null;
        $this->error = $_SESSION['msg_error'] ?? null;

            if (isset($this->error)) {
         	    if ($this->error['count'] ===0) {
                    $_SESSION['msg_error']['count']++;
         	}else{
         		unset($_SESSION['msg_error']);
         	}
        }
   	    }

        

        public function start($urlGet)
        {
                 
                        
            if(isset($urlGet['class'])){
                $this->controller = ucfirst($urlGet['class'].'Controller');
                    if(isset($urlGet['method'])){
                        $this->method = $urlGet['method'];
                    }

            }
            else{
                $this->controller = 'LoginController';
            }
            
            //oq fazer se existe um usuário logado
            if ($this->user){
                $permitions = $_SESSION['usr']['permitions'];
                $usrname = $_SESSION['usr']['name_user'];

                $pg_permission = explode(',', $permitions);
                
                $template = file_get_contents('app/Template/estrutura.html');

                $saida = ob_get_contents();
                    ob_end_clean();

                    $areasdesubs = array('{{nome}}', '{{conteudo}}');
                    $parasubs = array($usrname, $saida);

                    $tplPronto = str_replace($areasdesubs, $parasubs, $template);
                   

                    echo $tplPronto;

                //caso a url não contenha uma classe
                if (!isset($this->controller) || !in_array($this->controller, $pg_permission)) {
                        $this->controller = 'HomeController';
                        $this->method = 'index';
                }
                //caso não exista o metódo na classe solicitada
                if(!method_exists($this->controller, $this->method)){
                    $this->method = 'index';
                    //echo 'não existe';
                }

            //caso não exista um usuário logado
            } else{
                $pg_permission = ['LoginController'];
   
                if (!isset($this->controller) || !in_array($this->controller, $pg_permission)) {
                        $this->controller = 'LoginController';
                        $this->method = 'index';
                }
            } 

            if(isset($request['id']) && $request['id'] != null){
                $this->id = $request['id'];
            }

            
            call_user_func_array(array(new $this->controller, $this->method), array($urlGet));
            
            
        }

      

    }

?>
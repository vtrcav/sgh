<?php

    class LogoutController
    {
        public function index()
        {
            $_SESSION = array();
            
            session_destroy();

            header('Location: ./');
        }
    }
?>
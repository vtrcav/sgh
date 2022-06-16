<?php

    class LogoutController
    {
        public function index()
        {
            $_SESSION = array();
            
            session_destroy();

            echo '<script>location.href="?class=Login"</script>';
        }
    }
?>
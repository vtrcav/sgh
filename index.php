<?php
    session_start();

    require_once 'app/Core/Core.php';

    require_once 'lib/Database/Connection.php';
    require_once 'lib/Password.php';

    require_once 'app/Controller/LoginController.php';
    require_once 'app/Controller/LogoutController.php';

    require_once 'app/Controller/HomeController.php';
    require_once 'app/Controller/ListaPacientesController.php';
    require_once 'app/Controller/ListaUsuariosController.php';
    require_once 'app/Controller/ListaInsumoseMedicamentosController.php';

    require_once 'app/Model/User.php';
    require_once 'app/Model/Pacientes.php';
    require_once 'app/Model/IMedicamentos.php';
    require_once 'app/Model/ConsultaDatabase.php';

    require_once 'vendor/autoload.php';

    $template = file_get_contents('App/Template/estrutura.html');

    ob_start();
        $core = new Core;
        $core->start($_GET);
        
        /* $saida = ob_get_contents();
    ob_end_clean();

    $tplPronto = str_replace('{{conteudo}}', $saida, $template);

    echo $tplPronto; */

?>
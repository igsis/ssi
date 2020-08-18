<?php
$pedidoAjax = true;
require_once "../config/configGeral.php";

if (isset($_POST['_method'])) {
    require_once "../controllers/AdministradorController.php";
    $administradorObj = new AdministradorController();

    switch ($_POST['_method']) {
        case 'insereAdmin':
            echo $administradorObj->nivelAcesso(2);
            break;

        case 'removeAdmin':
            echo $administradorObj->nivelAcesso(1);
            break;
    }
} else {
    include_once "../config/destroySession.php";
}
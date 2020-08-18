<?php
$pedidoAjax = true;
require_once "../config/configGeral.php";

if (isset($_POST['_method'])) {
    require_once "../controllers/AdministradorController.php";
    $adminObj = new AdministradorController();

    switch ($_POST['_method']) {
        case 'insereAdmin':
            echo $adminObj->insereAdmin();
    }
} else {
    include_once "../config/destroySession.php";
}
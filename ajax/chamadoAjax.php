<?php
$pedidoAjax = true;
require_once "../config/configGeral.php";

if (isset($_POST['_method'])) {
    require_once "../controllers/ChamadoController.php";
    $insChamado = new ChamadoController();

    if ($_POST['_method'] == "cadastrar") {
        echo $insChamado->insereChamado();
    } elseif ($_POST['_method'] == "editar") {
        echo $insChamado->editaChamado($_POST['id']);
    }

} else {
    include_once "../config/destroySession.php";
}
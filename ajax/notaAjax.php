<?php
$pedidoAjax = true;
require_once "../config/configGeral.php";

if (isset($_POST['_method'])) {
    require_once "../controllers/NotaController.php";
    $insNota = new NotaController();

    if ($_POST['_method'] == "cadastrar") {
        echo $insNota->insereNota();
    }

} else {
    include_once "../config/destroySession.php";
}
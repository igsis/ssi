<?php
$pedidoAjax = true;
require_once "../config/configGeral.php";

if (isset($_POST['_method'])) {
    require_once "../controllers/ChamadoController.php";
    $insChamado = new ChamadoController();

    if ($_POST['_method'] == "cadastrar") {
        echo $insChamado->insereChamado($_POST['pagina']);
    } elseif ($_POST['_method'] == "editar") {
        echo $insChamado->editaChamado($_POST['id'], $_POST['pagina']);
    } elseif ($_POST['_method'] == "remover"){
        echo $insChamado->removeChamado($_POST['pagina']);
    }

} else {
    include_once "../config/destroySession.php";
}
<?php
if ($pedidoAjax) {
    require_once "../models/UsuarioModel.php";
} else {
    require_once "./models/UsuarioModel.php";
}

class AdministradorController extends UsuarioController
{
    public function listaAdmins()
    {
        return DbModel::consultaSimples("SELECT * FROM usuarios WHERE publicado = 1 AND nivel_acesso_id = 2")->fetchAll(PDO::FETCH_OBJ);
    }
}
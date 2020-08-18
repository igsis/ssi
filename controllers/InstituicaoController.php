<?php
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class InstituicaoController extends MainModel
{
    public function listaInstituicoes()
    {
        return DbModel::consultaSimples("SELECT * FROM instituicoes")->fetchAll(PDO::FETCH_OBJ);
    }
}
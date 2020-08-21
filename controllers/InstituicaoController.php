<?php
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class InstituicaoController extends MainModel
{
    /** <p>Retorna um array com todas instituições cadastradas</p>
     * @return array
     */
    public function listaInstituicoes()
    {
        return DbModel::consultaSimples("SELECT * FROM instituicoes")->fetchAll(PDO::FETCH_OBJ);
    }
}
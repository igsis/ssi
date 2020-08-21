<?php

if ($pedidoAjax) {
    require_once "../models/InstituicaoModel.php";
} else {
    require_once "./models/InstituicaoModel.php";
}


class InstituicaoController extends InstituicaoModel
{
    public function recuperaInstituicao($id)
    {
        $instituicao = DbModel::getInfo('intituicoes',$id);
        return $instituicao;
    }

    public function recuperaAdministrador($instituicao)
    {
        $adm = InstituicaoModel::getAdministrador($instituicao);
        return $adm->fetchObject();
    }

    public function listaInstituicao()
    {
        return DbModel::consultaSimples("SELECT * FROM instituicoes")->fetchAll(PDO::FETCH_OBJ);
    }
}

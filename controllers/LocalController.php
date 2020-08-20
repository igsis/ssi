<?php

if ($pedidoAjax) {
    require_once "../models/LocalModel.php";
} else {
    require_once "./models/LocalModel.php";
}


class LocalController extends LocalModel
{
    public function listaLocais()
    {
        return DbModel::consultaSimples("SELECT * FROM locais")->fetchAll(PDO::FETCH_OBJ);
    }
    public function recuperaLocal($id)
    {
        $local = DbModel::getInfo('locais',$id);
        return $local;
    }

    public function recuperaInstituicaoLocal($local_id)
    {
        return parent::getInstituicaoLocal($local_id)->fetchColumn();
    }

    public function recuperaLocalInstituicao($id)
    {
        $local = LocalModel::getLocalInstituicao($id);
        return $local;
    }

    public function recuperaAdministrador($usuario='',$local='')
    {
        $adm = LocalModel::getAdministrador(["usuario"=>$usuario,"local"=>$local]);
        return $adm;
    }
}

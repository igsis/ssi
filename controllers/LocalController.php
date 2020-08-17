<?php

if ($pedidoAjax) {
    require_once "../models/LocalModel.php";
} else {
    require_once "./models/LocalModel.php";
}


class LocalController extends LocalModel
{
    public function recuperaLocal($id)
    {
        $local = DbModel::getInfo('locais',$id);
        return $local;
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
